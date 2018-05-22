<?php
/*
Version 1.0
PNP4Nagios Template file for 'mysql_stats.pl'
Inspired by Percona Cacti MySQL Templates

Juraj Havrila, 16.05.2018
https://github.com/juraj-havrila/check_mysql_stats
*/


foreach ($this->DS as $KEY=>$VAL) {
	$my_name=$VAL['NAME'];
	$position[$my_name]=$KEY+1;
	}

//Graph 1 : MySQL Threads & Connections

$pom = 1;

$ds_name[$pom] = 'Threads & Connections';
$opt[$pom] = "--title \"$hostname - MySQL Threads & Connections\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["MAX_CONNECTIONS"];
$def[$pom] = rrd::def("MAX_CONNECTIONS", $RRDFILE[$my_pos], $DS[$my_pos], "MAX");
$my_pos=$position["MAX_USED_CONNECTIONS"];
$def[$pom] .= rrd::def("MAX_USED_CONNECTIONS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["ABORTED_CLIENTS"];
$def[$pom] .= rrd::def("ABORTED_CLIENTS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["ABORTED_CONNECTS"];
$def[$pom] .= rrd::def("ABORTED_CONNECTS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["THREADS_CONNECTED"];
$def[$pom] .= rrd::def("THREADS_CONNECTED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["CONNECTIONS"];
$def[$pom] .= rrd::def("CONNECTIONS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["THREADS_CACHED"];
$def[$pom] .= rrd::def("THREADS_CACHED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["THREADS_CREATED"];
$def[$pom] .= rrd::def("THREADS_CREATED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["THREADS_RUNNING"];
$def[$pom] .= rrd::def("THREADS_RUNNING", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["THREAD_CACHE_SIZE"];
$def[$pom] .= rrd::def("THREAD_CACHE_SIZE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_var='MAX_CONNECTIONS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("MAX_CONNECTIONS", "#4d004d",$label) ;
$def[$pom] .= rrd::gprint("MAX_CONNECTIONS","LAST","%7.0lf \\n") ;
$my_var='MAX_USED_CONNECTIONS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("MAX_USED_CONNECTIONS",'#cc0052',$label);
$def[$pom] .= rrd::gprint("MAX_USED_CONNECTIONS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='ABORTED_CLIENTS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("ABORTED_CLIENTS",'#ff8080',$label);
$def[$pom] .= rrd::gprint("ABORTED_CLIENTS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='ABORTED_CONNECTS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("ABORTED_CONNECTS",'#d98cb3',$label);
$def[$pom] .= rrd::gprint("ABORTED_CONNECTS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='CONNECTIONS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("CONNECTIONS",'#ff6600',$label);
$def[$pom] .= rrd::gprint("CONNECTIONS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='THREAD_CACHE_SIZE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1( "THREAD_CACHE_SIZE", "#e6fff2",$label);
$def[$pom] .= rrd::gprint("THREAD_CACHE_SIZE","LAST","%7.0lf \\n") ;
$my_var='THREADS_CONNECTED';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("THREADS_CONNECTED",'#00cc00',$label);
$def[$pom] .= rrd::gprint("THREADS_CONNECTED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='THREADS_CACHED';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("THREADS_CACHED",'#cccc00',$label);
$def[$pom] .= rrd::gprint("THREADS_CACHED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='THREADS_CREATED';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("THREADS_CREATED",'#00b3b3',$label);
$def[$pom] .= rrd::gprint("THREADS_CREATED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='THREADS_RUNNING';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("THREADS_RUNNING",'#009933',$label);
$def[$pom] .= rrd::gprint("THREADS_RUNNING",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



//Graph 2 : Commands Counters

++$pom;
$ds_name[$pom] = 'Command Counters';
$opt[$pom] = "--title \"$hostname - Command Counters\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["QUERIES"];
$def[$pom] = rrd::def("QUERIES", $RRDFILE[$my_pos], $DS[$my_pos], "MAX");
$my_pos=$position["COM_SELECT"];
$def[$pom] .= rrd::def("COM_SELECT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_LOAD"];
$def[$pom] .= rrd::def("COM_LOAD", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QUESTIONS"];
$def[$pom] .= rrd::def("QUESTIONS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_INSERT"];
$def[$pom] .= rrd::def("COM_INSERT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_UPDATE"];
$def[$pom] .= rrd::def("COM_UPDATE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_REPLACE"];
$def[$pom] .= rrd::def("COM_REPLACE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_DELETE"];
$def[$pom] .= rrd::def("COM_DELETE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_INSERT_SELECT"];
$def[$pom] .= rrd::def("COM_INSERT_SELECT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_UPDATE_MULTI"];
$def[$pom] .= rrd::def("COM_UPDATE_MULTI", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["COM_REPLACE_SELECT"];
$def[$pom] .= rrd::def("COM_REPLACE_SELECT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='QUERIES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("QUERIES",'#e6e5e5',$label);
$def[$pom] .= rrd::gprint("QUERIES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_SELECT';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_SELECT",'#b3f0ff',$label);
$def[$pom] .= rrd::gprint("COM_SELECT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_LOAD';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_LOAD",'#80bfff',$label,1);
$def[$pom] .= rrd::gprint("COM_LOAD",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_INSERT';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_INSERT",'#85e085',$label,1);
$def[$pom] .= rrd::gprint("COM_INSERT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_UPDATE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_UPDATE",'#00cccc',$label,1);
$def[$pom] .= rrd::gprint("COM_UPDATE",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_REPLACE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_REPLACE",'#ffcc66',$label,1);
$def[$pom] .= rrd::gprint("COM_REPLACE",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_DELETE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_DELETE",'#ff8080',$label,1);
$def[$pom] .= rrd::gprint("COM_DELETE",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_INSERT_SELECT';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_INSERT_SELECT",'#ccff99',$label,1);
$def[$pom] .= rrd::gprint("COM_INSERT_SELECT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_UPDATE_MULTI';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_UPDATE_MULTI",'#00cc99',$label,1);
$def[$pom] .= rrd::gprint("COM_UPDATE_MULTI",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='COM_REPLACE_SELECT';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("COM_REPLACE_SELECT",'#b3b3ff',$label,1);
$def[$pom] .= rrd::gprint("COM_REPLACE_SELECT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QUESTIONS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("QUESTIONS",'#eee6ff',$label,1);
$def[$pom] .= rrd::gprint("QUESTIONS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 3 : Query Cache.

++$pom;
$ds_name[$pom] = 'MySQL Query Cache';
$opt[$pom] = "--title \"$hostname - MySQL Query Cache\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["QCACHE_QUERIES_IN_CACHE"];
$def[$pom] = rrd::def("QCACHE_QUERIES_IN_CACHE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QCACHE_HITS"];
$def[$pom] .= rrd::def("QCACHE_HITS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QCACHE_INSERTS"];
$def[$pom] .= rrd::def("QCACHE_INSERTS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QCACHE_LOWMEM_PRUNES"];
$def[$pom] .= rrd::def("QCACHE_LOWMEM_PRUNES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QCACHE_NOT_CACHED"];
$def[$pom] .= rrd::def("QCACHE_NOT_CACHED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='QCACHE_QUERIES_IN_CACHE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("QCACHE_QUERIES_IN_CACHE",'#ffb3b3');
$def[$pom] .= rrd::line1("QCACHE_QUERIES_IN_CACHE",'#ff0000',$label);
$def[$pom] .= rrd::gprint("QCACHE_QUERIES_IN_CACHE",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QCACHE_HITS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("QCACHE_HITS",'#ffaa00',$label);
$def[$pom] .= rrd::gprint("QCACHE_HITS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QCACHE_INSERTS';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("QCACHE_INSERTS",'#0099ff',$label);
$def[$pom] .= rrd::gprint("QCACHE_INSERTS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QCACHE_LOWMEM_PRUNES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("QCACHE_LOWMEM_PRUNES",'#990000',$label);
$def[$pom] .= rrd::gprint("QCACHE_LOWMEM_PRUNES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QCACHE_NOT_CACHED';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("QCACHE_NOT_CACHED",'#009933',$label);
$def[$pom] .= rrd::gprint("QCACHE_NOT_CACHED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 4 : Query Cache Memory

++$pom;
$ds_name[$pom] = 'MySQL Query Cache Memory';
$opt[$pom] = "--title \"$hostname - MySQL Query Cache Memory\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["QUERY_CACHE_SIZE"];
$def[$pom] = rrd::def("QUERY_CACHE_SIZE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QCACHE_FREE_MEMORY"];
$def[$pom] .= rrd::def("QCACHE_FREE_MEMORY", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["QCACHE_TOTAL_BLOCKS"];
$def[$pom] .= rrd::def("QCACHE_TOTAL_BLOCKS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$def[$pom] .= rrd::cdef("B_QCACHE_TOTAL_BLOCKS","QCACHE_TOTAL_BLOCKS,512,*");
$my_pos=$position["QCACHE_FREE_BLOCKS"];
$def[$pom] .= rrd::def("QCACHE_FREE_BLOCKS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$def[$pom] .= rrd::cdef("B_QCACHE_FREE_BLOCKS","QCACHE_FREE_BLOCKS,512,*");

$my_var='QUERY_CACHE_SIZE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("QUERY_CACHE_SIZE",'#e6eeff',$label);
$def[$pom] .= rrd::gprint("QUERY_CACHE_SIZE","MAX","%7.0lf \\n") ;
$my_var='QCACHE_TOTAL';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("B_QCACHE_TOTAL_BLOCKS",'#264d00',$label);
$def[$pom] .= rrd::gprint("B_QCACHE_TOTAL_BLOCKS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QCACHE_FREE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("B_QCACHE_FREE_BLOCKS",'#009933',$label,1);
$def[$pom] .= rrd::gprint("B_QCACHE_FREE_BLOCKS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='QCACHE_FREE_MEMORY';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("QCACHE_FREE_MEMORY",'#ccff99',$label,1);
$def[$pom] .= rrd::gprint("QCACHE_FREE_MEMORY",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 5 : Table Locks

++$pom;
$ds_name[$pom] = 'MySQL Table Locks';
$opt[$pom] = "--title \"$hostname - MySQL Table Locks\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["TABLE_LOCKS_IMMEDIATE"];
$def[$pom] = rrd::def("TABLE_LOCKS_IMMEDIATE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["TABLE_LOCKS_WAITED"];
$def[$pom] .= rrd::def("TABLE_LOCKS_WAITED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["SLOW_QUERIES"];
$def[$pom] .= rrd::def("SLOW_QUERIES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='TABLE_LOCKS_IMMEDIATE';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("TABLE_LOCKS_IMMEDIATE",'#99bbff');
$def[$pom] .= rrd::line1("TABLE_LOCKS_IMMEDIATE",'#1a66ff',$label);
$def[$pom] .= rrd::gprint("TABLE_LOCKS_IMMEDIATE",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='TABLE_LOCKS_WAITED';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("TABLE_LOCKS_WAITED",'#ff66a3');
$def[$pom] .= rrd::line1("TABLE_LOCKS_WAITED",'#e6005c',$label);
$def[$pom] .= rrd::gprint("TABLE_LOCKS_WAITED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='SLOW_QUERIES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("SLOW_QUERIES",'#e67300',$label);
$def[$pom] .= rrd::gprint("SLOW_QUERIES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 6: Temporary Objects

++$pom;
$ds_name[$pom] = 'MySQL Temporary Objects';
$opt[$pom] = "--title \"$hostname - MySQL Temporary Objects\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["CREATED_TMP_TABLES"];
$def[$pom] = rrd::def("CREATED_TMP_TABLES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["CREATED_TMP_DISK_TABLES"];
$def[$pom] .= rrd::def("CREATED_TMP_DISK_TABLES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["CREATED_TMP_FILES"];
$def[$pom] .= rrd::def("CREATED_TMP_FILES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='CREATED_TMP_TABLES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("CREATED_TMP_TABLES",'#ffcc80');
$def[$pom] .= rrd::line1("CREATED_TMP_TABLES",'#cc7a00',$label);
$def[$pom] .= rrd::gprint("CREATED_TMP_TABLES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='CREATED_TMP_DISK_TABLES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("CREATED_TMP_DISK_TABLES",'#6666ff',$label);
$def[$pom] .= rrd::gprint("CREATED_TMP_DISK_TABLES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='CREATED_TMP_FILES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("CREATED_TMP_FILES",'#40ff00',$label);
$def[$pom] .= rrd::gprint("CREATED_TMP_FILES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 7: Network Traffic

++$pom;
$ds_name[$pom] = 'MySQL Network Traffic';
$opt[$pom] = "--title \"$hostname - MySQL Network Traffic\"";
$opt[$pom] .= " --slope-mode ";
$opt[$pom] .= " --vertical-label \"Data throughput per scan period \" ";

$my_pos=$position["BYTES_SENT"];
$def[$pom] = rrd::def("BYTES_SENT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
//$def[$pom] .= rrd::cdef("PREV_BYTES_SENT","PREV(BYTES_SENT)");
//$def[$pom] .= rrd::cdef("TREND_BYTES_SENT","BYTES_SENT,PREV_BYTES_SENT,-");
$my_pos=$position["BYTES_RECEIVED"];
$def[$pom] .= rrd::def("BYTES_RECEIVED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
//$def[$pom] .= rrd::cdef("PREV_BYTES_RECEIVED","PREV(BYTES_RECEIVED)");
//$def[$pom] .= rrd::cdef("TREND_BYTES_RECEIVED","BYTES_RECEIVED,PREV_BYTES_RECEIVED,-");
$def[$pom] .= rrd::cdef("NEG_BYTES_RECEIVED","BYTES_RECEIVED,-1,*");

$my_var='BYTES_SENT';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("BYTES_SENT",'#3399ff');
$def[$pom] .= rrd::line1("BYTES_SENT",'#0080ff',$label);
$def[$pom] .= rrd::gprint("BYTES_SENT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='BYTES_RECEIVED';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::area("NEG_BYTES_RECEIVED",'#00ffff');
$def[$pom] .= rrd::line1("NEG_BYTES_RECEIVED",'#00cccc',$label);
$def[$pom] .= rrd::gprint("BYTES_RECEIVED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 7 : Transaction Handler

++$pom;
$ds_name[$pom] = 'MySQL Transactions Handler';
$opt[$pom] = "--title \"$hostname - MySQL Transaction Handler\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["HANDLER_COMMIT"];
$def[$pom] = rrd::def("HANDLER_COMMIT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["HANDLER_ROLLBACK"];
$def[$pom] .= rrd::def("HANDLER_ROLLBACK", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["HANDLER_SAVEPOINT"];
$def[$pom] .= rrd::def("HANDLER_SAVEPOINT", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["HANDLER_SAVEPOINT_ROLLBACK"];
$def[$pom] .= rrd::def("HANDLER_SAVEPOINT_ROLLBACK", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='HANDLER_COMMIT';
$label = rrd::cut($my_var,27);
$def[$pom] .= rrd::line1("HANDLER_COMMIT",'#ff6600',$label);
$def[$pom] .= rrd::gprint("HANDLER_COMMIT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='HANDLER_ROLLBACK';
$label = rrd::cut($my_var,27);
$def[$pom] .= rrd::line1("HANDLER_ROLLBACK",'#ff4d4d',$label);
$def[$pom] .= rrd::gprint("HANDLER_ROLLBACK",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='HANDLER_SAVEPOINT';
$label = rrd::cut($my_var,27);
$def[$pom] .= rrd::line1("HANDLER_SAVEPOINT",'#e6e600',$label);
$def[$pom] .= rrd::gprint("HANDLER_SAVEPOINT",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='HANDLER_SAVEPOINT_ROLLBACK';
$label = rrd::cut($my_var,27);
$def[$pom] .= rrd::line1("HANDLER_SAVEPOINT_ROLLBACK",'#cca300',$label);
$def[$pom] .= rrd::gprint("HANDLER_SAVEPOINT_ROLLBACK",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 8 : Files & Tables

++$pom;
$ds_name[$pom] = 'MySQL Files & Tables';
$opt[$pom] = "--title \"$hostname - MySQL Files & Tables\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["TABLE_OPEN_CACHE"];
$def[$pom] = rrd::def("TABLE_OPEN_CACHE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["OPEN_FILES"];
$def[$pom] .= rrd::def("OPEN_FILES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["OPENED_FILES"];
$def[$pom] .= rrd::def("OPENED_FILES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["OPEN_TABLES"];
$def[$pom] .= rrd::def("OPEN_TABLES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["OPENED_TABLES"];
$def[$pom] .= rrd::def("OPENED_TABLES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='TABLE_OPEN_CACHE';
$label = rrd::cut($my_var . " size",23);
$def[$pom] .= rrd::line2("TABLE_OPEN_CACHE",'#d1d1c1',$label);
$def[$pom] .= rrd::gprint("TABLE_OPEN_CACHE","LAST","%7.0lf \\n") ;
$my_var='OPEN_FILES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("OPEN_FILES",'#33ccff',$label);
$def[$pom] .= rrd::gprint("OPEN_FILES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='OPENED_FILES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("OPENED_FILES",'#9999ff',$label);
$def[$pom] .= rrd::gprint("OPENED_FILES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='OPEN_TABLES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("OPEN_TABLES",'#ff6699',$label);
$def[$pom] .= rrd::gprint("OPEN_TABLES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='OPENED_TABLES';
$label = rrd::cut($my_var,23);
$def[$pom] .= rrd::line1("OPENED_TABLES",'#cc00cc',$label);
$def[$pom] .= rrd::gprint("OPENED_TABLES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 9 : InnoDB Buffer Pool

++$pom;
$ds_name[$pom] = 'MySQL InnoDB Buffer Pool';
$opt[$pom] = "--title \"$hostname - MySQL InnoDB Buffer Pool\"";
$opt[$pom] .= " --vertical-label \"[ PAGES ] \" ";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["INNODB_BUFFER_POOL_PAGES_TOTAL"];
$def[$pom] = rrd::def("INNODB_BUFFER_POOL_PAGES_TOTAL", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_BUFFER_POOL_PAGES_DATA"];
$def[$pom] .= rrd::def("INNODB_BUFFER_POOL_PAGES_DATA", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_BUFFER_POOL_PAGES_FREE"];
$def[$pom] .= rrd::def("INNODB_BUFFER_POOL_PAGES_FREE", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_BUFFER_POOL_PAGES_DIRTY"];
$def[$pom] .= rrd::def("INNODB_BUFFER_POOL_PAGES_DIRTY", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='INNODB_BUFFER_POOL_PAGES_TOTAL';
$label = rrd::cut("InnoDB Buffer Pool size",30);
$def[$pom] .= rrd::area("INNODB_BUFFER_POOL_PAGES_TOTAL",'#99ccff',$label);
$def[$pom] .= rrd::gprint("INNODB_BUFFER_POOL_PAGES_TOTAL","LAST","%7.0lf \\n") ;
$my_var='INNODB_BUFFER_POOL_PAGES_DATA';
$label = rrd::cut("Pages containing Data",30);
$def[$pom] .= rrd::area("INNODB_BUFFER_POOL_PAGES_DATA",'#ac7339',$label);
$def[$pom] .= rrd::gprint("INNODB_BUFFER_POOL_PAGES_DATA",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_BUFFER_POOL_PAGES_FREE';
$label = rrd::cut("Free Pages",30);
$def[$pom] .= rrd::area("INNODB_BUFFER_POOL_PAGES_FREE",'#dfff80',$label,1);
$def[$pom] .= rrd::gprint("INNODB_BUFFER_POOL_PAGES_FREE",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_BUFFER_POOL_PAGES_DIRTY';
$label = rrd::cut("Dirty Pages",30);
$def[$pom] .= rrd::area("INNODB_BUFFER_POOL_PAGES_DIRTY",'#ff8533');
$def[$pom] .= rrd::line1("INNODB_BUFFER_POOL_PAGES_DIRTY",'#ff6600',$label);
$def[$pom] .= rrd::gprint("INNODB_BUFFER_POOL_PAGES_DIRTY",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 10 : InnoDB Buffer Pool Activity

++$pom;
$ds_name[$pom] = 'MySQL InnoDB Buffer Pool Activity';
$opt[$pom] = "--title \"$hostname - InnoDB Buffer Pool Activity\"";
$opt[$pom] .= " --vertical-label \"[ PAGES ] \" ";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["INNODB_PAGES_CREATED"];
$def[$pom] = rrd::def("INNODB_PAGES_CREATED", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_PAGES_READ"];
$def[$pom] .= rrd::def("INNODB_PAGES_READ", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_PAGES_WRITTEN"];
$def[$pom] .= rrd::def("INNODB_PAGES_WRITTEN", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='INNODB_PAGES_CREATED';
$label = rrd::cut($my_var,25);
$def[$pom] .= rrd::line1("INNODB_PAGES_CREATED",'#339966',$label);
$def[$pom] .= rrd::gprint("INNODB_PAGES_CREATED",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_PAGES_READ';
$label = rrd::cut($my_var,25);
$def[$pom] .= rrd::line1("INNODB_PAGES_READ",'#999966',$label);
$def[$pom] .= rrd::gprint("INNODB_PAGES_READ",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_PAGES_WRITTEN';
$label = rrd::cut($my_var,25);
$def[$pom] .= rrd::line1("INNODB_PAGES_WRITTEN",'#006699',$label);
$def[$pom] .= rrd::gprint("INNODB_PAGES_WRITTEN",array("LAST","MAX","AVERAGE"),"%7.0lf") ;



// Graph 11: InnoDB I/O

++$pom;
$ds_name[$pom] = 'MySQL InnoDB I/O';
$opt[$pom] = "--title \"$hostname - MySQL InnoDB I/O\"";
$opt[$pom] .= " --slope-mode ";

$my_pos=$position["INNODB_DATA_FSYNCS"];
$def[$pom] = rrd::def("INNODB_DATA_FSYNCS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_DATA_PENDING_FSYNCS"];
$def[$pom] .= rrd::def("INNODB_DATA_PENDING_FSYNCS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_DATA_READS"];
$def[$pom] .= rrd::def("INNODB_DATA_READS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_DATA_PENDING_READS"];
$def[$pom] .= rrd::def("INNODB_DATA_PENDING_READS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_DATA_WRITES"];
$def[$pom] .= rrd::def("INNODB_DATA_WRITES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_DATA_PENDING_WRITES"];
$def[$pom] .= rrd::def("INNODB_DATA_PENDING_WRITES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_LOG_WRITES"];
$def[$pom] .= rrd::def("INNODB_LOG_WRITES", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");
$my_pos=$position["INNODB_LOG_WAITS"];
$def[$pom] .= rrd::def("INNODB_LOG_WAITS", $RRDFILE[$my_pos], $DS[$my_pos], "AVERAGE");

$my_var='INNODB_DATA_FSYNCS';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_DATA_FSYNCS",'#cca300',$label);
$def[$pom] .= rrd::gprint("INNODB_DATA_FSYNCS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_DATA_PENDING_FSYNCS';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_DATA_PENDING_FSYNCS",'#ffd11a',$label);
$def[$pom] .= rrd::gprint("INNODB_DATA_PENDING_FSYNCS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_DATA_READS';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_DATA_READS",'#008000',$label);
$def[$pom] .= rrd::gprint("INNODB_DATA_READS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_DATA_PENDING_READS';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_DATA_PENDING_READS",'#00e600',$label);
$def[$pom] .= rrd::gprint("INNODB_DATA_PENDING_READS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_DATA_WRITES';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_DATA_WRITES",'#005ce6',$label);
$def[$pom] .= rrd::gprint("INNODB_DATA_WRITES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_DATA_PENDING_WRITES';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_DATA_PENDING_WRITES",'#33adff',$label);
$def[$pom] .= rrd::gprint("INNODB_DATA_PENDING_WRITES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_LOG_WRITES';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_LOG_WRITES",'#990099',$label);
$def[$pom] .= rrd::gprint("INNODB_LOG_WRITES",array("LAST","MAX","AVERAGE"),"%7.0lf") ;
$my_var='INNODB_LOG_WAITS';
$label = rrd::cut($my_var,30);
$def[$pom] .= rrd::line1("INNODB_LOG_WAITS",'#ff1aff',$label);
$def[$pom] .= rrd::gprint("INNODB_LOG_WAITS",array("LAST","MAX","AVERAGE"),"%7.0lf") ;


?>
