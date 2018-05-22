#!/usr/bin/perl
#Nagios plugin for collecting MySQL Utilization Statistics Data from MySQL Server (from 'GLOBAL_STATUS' Table) 
#Check does not throw alerts triggered by exceeding thresholds it is supposed to collect data for PNP4Nagios trending, use with template 'mysql_stats.php'
#can be run locally (tested with check_by_ssh) or remotelly if selects from Nagis Server are allowed
#This script does not require any Perl DBI, the select statement is done using Mysql client from bash
# 
#Juraj Havrila, 2018-05-08
#

use strict;
use warnings;
use Getopt::Std;
#use Data::Dumper;
# 0| OK         1|WARNING       2|CRITICAL      3|UNKNOWN
my $return_code=3; 

my $mysql_binary = '/usr/bin/mysql';

my $select_statement="SELECT * FROM INFORMATION_SCHEMA.GLOBAL_STATUS union SELECT VARIABLE_NAME, VARIABLE_VALUE FROM INFORMATION_SCHEMA.GLOBAL_VARIABLES WHERE VARIABLE_NAME = 'MAX_CONNECTIONS' OR VARIABLE_NAME='QUERY_CACHE_SIZE' OR VARIABLE_NAME='TABLE_OPEN_CACHE' OR VARIABLE_NAME='THREAD_CACHE_SIZE' ORDER BY VARIABLE_NAME";

# Mapping of variables to units, this hash also works as filter (only the listed variables are sent to Nagios Server)
my %variable_map = (
    'ABORTED_CLIENTS'                           => 'c',     #1 MySQL Threads & Connections
    'ABORTED_CONNECTS'                          => 'c',     #1 MySQL Threads & Connections
    'BYTES_RECEIVED'                            => 'c',     #7 Network Traffic
    'BYTES_SENT'                                => 'c',     #7 Network Traffic
    'COM_CALL_PROCEDURE'                        => 'c',     #2 Command counters
    'COM_DELETE'                                => 'c',     #2 Command counters
    'COM_DELETE_MULTI'                          => 'c',     #2 Command counters
    'COM_INSERT'                                => 'c',     #2 Command counters
    'COM_INSERT_SELECT'                         => 'c',     #2 Command counters
    'COM_LOAD'                                  => 'c',     #2 Command counters
    'COM_REPLACE'                               => 'c',     #2 Command counters
    'COM_REPLACE_SELECT'                        => 'c',     #2 Command counters
    'COM_SELECT'                                => 'c',     #2 Command counters
    'COM_UPDATE'                                => 'c',     #2 Command counters
    'COM_UPDATE_MULTI'                          => 'c',     #2 Command counters
    'CONNECTIONS'                               => 'c',     #1 MySQL Threads & Connections
    'CREATED_TMP_DISK_TABLES'                   => 'c',     #6 Temporary Objects
    'CREATED_TMP_FILES'                         => 'c',     #6 Temporary Objects
    'CREATED_TMP_TABLES'                        => 'c',     #6 Temporary Objects
    'HANDLER_COMMIT'                            => 'c',     #7 Transaction Handler
    'HANDLER_ROLLBACK'                          => 'c',     #7 Transaction Handler
    'HANDLER_SAVEPOINT'                         => 'c',     #7 Transaction Handler
    'HANDLER_SAVEPOINT_ROLLBACK'                => 'c',     #7 Transaction Handler
    'INNODB_BUFFER_POOL_PAGES_DATA'             => '',      #9 InnoDB Buffer Pool
    'INNODB_BUFFER_POOL_PAGES_DIRTY'            => '',      #9 InnoDB Buffer Pool (opt)
    'INNODB_BUFFER_POOL_PAGES_FREE'             => '',      #9 InnoDB Buffer Pool
    'INNODB_BUFFER_POOL_PAGES_TOTAL'            => '',      #9 InnoDB Buffer Pool (total size)
    'INNODB_DATA_FSYNCS'                        => 'c',     #11 InnoDB I/O
    'INNODB_DATA_PENDING_FSYNCS'                => 'c',     #11 InnoDB I/O
    'INNODB_DATA_PENDING_READS'                 => 'c',     #11 InnoDB I/O
    'INNODB_DATA_PENDING_WRITES'                => 'c',     #11 InnoDB I/O
    'INNODB_DATA_READS'                         => 'c',     #11 InnoDB I/O
    'INNODB_DATA_WRITES'                        => 'c',     #11 InnoDB I/O
    'INNODB_LOG_WAITS'                          => 'c',     #11 InnoDB I/O
    'INNODB_LOG_WRITES'                         => 'c',     #11 InnoDB I/O
    'INNODB_PAGES_CREATED'                      => 'c',     #10 InnoDB Buffer Pool Activity
    'INNODB_PAGES_READ'                         => 'c',     #10 InnoDB Buffer Pool Activity
    'INNODB_PAGES_WRITTEN'                      => 'c',     #10 InnoDB Buffer Pool Activity
    'MAX_USED_CONNECTIONS'                      => '',      #1 MySQL Threads & Connections,  probably not a counter
    'OPEN_FILES'                                => '',      #8  Files & Tables
    'OPEN_TABLES'                               => '',      #8  Files & Tables
    'OPENED_FILES'                              => 'c',     #8  Files & Tables
    'OPENED_TABLES'                             => 'c',     #8  Files & Tables
    'QCACHE_FREE_BLOCKS'                        => '',      #4 Query Cache Memory
    'QCACHE_FREE_MEMORY'                        => '',      #4 Query Cache Memory
    'QCACHE_HITS'                               => 'c',     #3 Query Cache
    'QCACHE_INSERTS'                            => 'c',     #3 Query Cache
    'QCACHE_LOWMEM_PRUNES'                      => 'c',     #3 Query Cache
    'QCACHE_NOT_CACHED'                         => 'c',     #3 Query Cache
    'QCACHE_QUERIES_IN_CACHE'                   => '',      #3 Query Cache
    'QCACHE_TOTAL_BLOCKS'                       => '',      #4 Query Cache Memory
    'QUERIES'                                   => 'c',     #2 Command counters
    'QUESTIONS'                                 => 'c',     #2 Command counters
    'SLOW_QUERIES'                              => 'c',     #5 Table locks
    'TABLE_LOCKS_IMMEDIATE'                     => 'c',     #5 Table locks
    'TABLE_LOCKS_WAITED'                        => 'c',     #5 Table locks
    'THREADS_CACHED'                            => '',      #1 MySQL Threads & Connections
    'THREADS_CONNECTED'                         => '',      #1 MySQL Threads & Connections
    'THREADS_CREATED'                           => 'c',     #1 MySQL Threads & Connections
    'THREADS_RUNNING'                           => '',      #1 MySQL Threads & Connections
    'MAX_CONNECTIONS'                           => '',      #1 MySQL Threads & Connections
    'QUERY_CACHE_SIZE'                          => 'B',     #4 Query Cache Memory
    'THREAD_CACHE_SIZE'                         => '',      #1 MySQL Threads & Connections
    'TABLE_OPEN_CACHE'                          => '',      #8  Files & Tables
);

my %opt;

sub usage() {
print STDERR << "EOF";

Collects Performance Data of MySQL Server

  usage: $0 [-H] host [-P] port [-u] user [-p] password
  example: $0 -H localhost -P 3306 -u nagios -p supergeheim
EOF
    exit 3;
    }

getopt( "HPup" , \%opt);
if (!$opt{H}){ print "Option -H is mandatory!\n"; usage(); }
if (!$opt{P}){ print "Option -P is mandatory!\n"; usage(); }
if (!$opt{u}){ print "Option -u is mandatory!\n"; usage(); }
if (!$opt{p}){ print "Option -p is mandatory!\n"; usage(); }

my $db_username = $opt{u};
my $db_password = $opt{p};
my $db_host = $opt{H};
my $db_port = $opt{P};


my %HoH_perfdata;

my @results = `echo "$select_statement" | $mysql_binary --user=$db_username --password=$db_password --host=$db_host --port=$db_port 2>&1`;

if ($?) {
    $return_code=1;
    print "WARNING: Check failed to execute: ERROR Code $? \n @results \n";
    exit $return_code;
    }


foreach my $my_result (@results) {
    my ($my_var, $my_val)  = split " ", uc($my_result);
    if (exists $variable_map{$my_var}) {
        $HoH_perfdata{$my_var} = $my_val . $variable_map{$my_var};
        }
    }

$return_code=0;
print "OK: MySQL Performance Data successfully collected. | ";

keys %HoH_perfdata;
while(my($k, $v) = each %HoH_perfdata){
    print "\'$k\'=$v ";
    }
print "\n";

exit $return_code;
1;
