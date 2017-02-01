<?php

class lib{
	
	public static function installedApps($server=""){
		if($server!=""){
			
		}
		//We're assuming that the query is to be run on the local system
		else{
			if(strpos($_SERVER["SERVER_SOFTWARE"],"Ubuntu")!==false||strpos($_SERVER["SERVER_SOFTWARE"],"Debian")!==false){
				$op=shell_exec("dpkg-query -l");
				$lines=explode("\n",$op);
				$apps=array();
				foreach($lines as $line){
					$data=preg_split("/\s{2,}/",$line);
					$apps[]=$data;
				}
				$raw=array_splice($apps,5);
				$out=array();
				foreach($raw as $pline){
					if($pline[0]!="") $out[]=array($pline[1],$pline[2]);
				}
			}
			elseif(strpos($_SERVER["SERVER_SOFTWARE"],"CentOS")!==false||strpos($_SERVER["SERVER_SOFTWARE"],"RHEL")!==false||strpos($_SERVER["SERVER_SOFTWARE"],"Fedora")!==false){
				$op=shell_exec("yum list installed");
				$lines=explode("\n",$op);
				$apps=array();
				foreach($lines as $line){
					$data=preg_split("/\s{2,}/",$line);
					$apps[]=$data;
				}
				$raw=array_splice($apps,2);
				$out=array();
				foreach($raw as $pline){
					if($pline[0]!="") $out[]=array($pline[0],$pline[1]);
				}
			}
		}
		return $out;
	}
	
}

print_r(lib::installedApps());