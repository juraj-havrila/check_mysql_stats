# check_mysql_stats
PNP4Nagios: MySQL Statistics (Check&amp;Template)


Nagios Check collecting MySQL Performance Data for PNP4Nagios and displaying it via provided template. Does not produce any alerts. Values are fetched from 'INFORMATION_SCHEMA.GLOBAL_STATUS' and 'INFORMATION_SCHEMA.GLOBAL_VARIABLES'. 

Does not require any Perl DBIs to be installed on scanned hosts, it works with the standard Perl Modules.

Supported MySQL Versions:
  -Tested with MySQL 5.6 and MariaDB 10 (should work with other versions as well) on SUSE Linux.
  
  
Remote or local (tested with 'check_by_ssh' but should work with NRPE also) execution possible.  
  

The Output is consolidated into 12 Graphs:
  
  1 : MySQL Threads & Connections
  2 : Commands Counters
  3 : Query Cache
  4 : Query Cache Memory
  5 : Table Locks
  6 : Temporary Objects
  7 : Network Traffic
  8 : Transaction Handler
  9 : Files & Tables
  10: InnoDB Buffer Pool
  11: InnoDB Buffer Pool Activity
  12: InnoDB I/O




HOW TO EXECUTE:

  usage: ./check_mysql_stats.pl [-H] host [-P] port [-u] user [-p] password
  example: ./check_mysql_stats.pl -H localhost -P 3306 -u nagios -p supergeheim



HOW TO DEPLOY:


  -copy the PHP Tempate into your PNP4Nagios Template Directory (e.g. "cat /etc/pnp4nagios/config.php |grep template_dirs")
  -create a service, e.g. (in this case it's executed over ssh):
        define service {
              hostgroup_name                  MYSQL-Server-LOCAL
              service_description             MYSQL_STATS
              use                             generic-service
              normal_check_interval           5
              parents                         SSH
              check_command                   check_by_ssh!mysql_stats
              action_url                      /pnp4nagios/index.php/graph?host=$HOSTNAME$&srv=$SERVICEDESC$
              }
  -create a command and a wrapper on the client side if needed
  




