<?php
//
//    StarAstAPI. A library to connect to Asterisk manager Interface. 
//    Copyright (C) <2006>  <S. A. Kamran Kamran@starutilities.com>
//
//    This library is free software; you can redistribute it and/or
//    modify it under the terms of the GNU Lesser General Public
//    License as published by the Free Software Foundation; either
//    version 2.1 of the License, or (at your option) any later version.
//
//    This library is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
//    Lesser General Public License for more details.
//
//    You should have received a copy of the GNU Lesser General Public
//    License along with this library; if not, write to the Free Software
//    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
//
// Ver 1.00
class MyCollection{
	protected $mObject=array();
	
	function __construct(){
		$this->Init();
	}
	function Count(){
	return count($this->mObject);

	}
	function Add($obj){
	array_push($this->mObject,$obj);
	}
	function AddKVPair($obj1, $obj2){
		$this->mObject[$obj1]=$obj2;
	}
	protected function Init(){
		//nothig to be initialized yet.
	}
	function Remove($cursor){
	try{
		unset($this->mObject[$cursor]);
		}
	catch(Exception $e) {
		//got an exception
		return false;
		}
	}
	function GetFirst(){
                reset($this->mObject);
		//print_r($this->mObject[0]);
                return ($this->mObject[0]);
        }

	function GetNext(){
		return next($this->mObject);
	}
	function Pop(){
		return array_pop($this->mObject);	
	}
	function GetAll(){
		return $this->mObject;
	}
	protected function Get($tKey){
		$tObjts = array_flip($this->mObject);
		return array_search($tKey, $tObjts);
	}
}

class AstPacket extends MyCollection{
	private $mType;
	
	function SetAstPacketData(AstPacketData $AstPacketData){
		MyCollection::Add($AstPacketData);	
	}
	function GetAstPacketData(){
		return MyCollection::GetFirst();
	}
	function SetAstPacketType($AstPacketType){
		$this->mType=$AstPacketType.":";	
	}
	function GetAstPacketType(){
		return $this->mType;
	}
	function GetActionID(){
		$apd=$this->GetAstPacketData();
                $KVPair=array_flip($apd->GetAll());
		return array_search("ActionID:",$KVPair);

	}
	function ToString(){
	        $mString = "";
		$apd=$this->GetAstPacketData();
			$KVPair=$apd->GetAll();
			while(list($Key,$Value)=each($KVPair)){	
				$mString .= "$Key $Value\r\n";

			}
			$mString = $mString."\r\n";
			return $mString;
	}

}

class AstPackets extends MyCollection{
	
	function AddAstPacket(AstPacket $AstPacket){
		Mycollection::Add($AstPacket);
	}
	function GetAstPacket(){
		//This uses FIFO
		$myastpacket=MyCollection::GetFirst();
		MyCollection::Remove(0);
		return $myastpacket;
	}
}

class AstPacketData extends MyCollection{
	private $mActionVariables=array();

	function AddKVPair($mKey, $mValue){
		$mKey = $mKey.":";
		MyCollection::AddKVPair($mKey,$mValue);
	}
	function AddActionVariable($varName, $varVal){
		$this->mActionVariables[$varName]=$varVal;
	}
	function GetEventType(){
		return MyCollection::Get("Event:");
	}
	function GetActionType(){
		return MyCollection::Get("Action:");
	}
	function GetResponseType(){
		return MyCollection::Get("Response:");
	}
}

class AstConnection{
        protected $mSrvIP;
        protected $mSrvPort;
        protected $mProtoType;
        protected $mSocket;
	protected $mCounter;

        protected function Connect($SrvIP,$SrvPort,$ProtoType){
                set_time_limit(0);
                ob_implicit_flush();
                if (($this->mSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) <0) {
                        return false;
                }
                if (($ret = socket_connect($this->mSocket, $SrvIP, $SrvPort)) <0){
                        return false;
                }else {
                        return true;
                }
        }
        function IsConnected(){
                if($this->mSocket < 0){
                        return true;
                }else{
                        return false;
                }
        }
        function SendPacket(AstPacket $ap){
		//echo "Now in send packet .... \r\n";
		//echo $ap->GetAstPacketType() ."\r\n";
                if($ap->GetAstPacketType()!="Action:"){
                        return false;
                }
                $MyStr=$ap->ToString();
                socket_write($this->mSocket,$MyStr,strlen($MyStr));

        }
	function Receive(){
		$tAstPacket = new AstPacket();
                $tAstPacketData = new AstPacketData();
		$tNeedPackets = true;

		while($this->mSocket && $tNeedPackets){
			if(!$rbuff=socket_read($this->mSocket, 2048)){
                                return false;
                        }
			//echo "receive buff=$rbuff \r\n";
			$arrbuff = explode("\r\n", $rbuff);
			//print_r($arrbuff);
			$dmy=array_pop($arrbuff);
			foreach($arrbuff as $tline){
				if(!strpos($tline,":")){
					$tAstPacket->SetAstPacketData($tAstPacketData);
					$tNeedPackets = $this->GotPacket($tAstPacket);

					if($tAstPacket->GetAstPacketType() == "Event:"){
						$tapd = $tAstPacket->GetAstPacketData();
						$tEventType = $tapd->GetEventType();
						$tNeedPackets = $this->GotEvent($tAstPacket, $tEventType);
					}//astpakcet type ends

					$tAstPacket = new AstPacket();
		            		$tAstPacketData = new AstPacketData();
					continue;
				} //if ends here	
				//echo "Line is = $tline \r\n";
				list($tKey,$tValue) = explode(":", $tline);
				//echo "Key=$tKey and value=$tValue \r\n";
				if($tKey=="Action" or $tKey=="Event" or $tKey=="Response"){
					if($tAstPacket->GetAstPacketType() == ""){
						//echo "Setting packet type to = $tKey \r\n";
						$tAstPacket->SetAstPacketType($tKey);
					}else {
						echo "Malformed Packet Discarding ...\r\n";
						echo $tAstPacket->GetAstPacketType() ."\r\n";
						echo "$tKey  $tValue \r\n";
						$tAstPacket = new AstPacket();
						$tAstPacketData = new AstPacketData();
						continue 2;
					} //if $tAstPacket ends
				} //if $tKey ends
				$tAstPacketData->AddKVPair($tKey, $tValue);
			} //foreach ends
		} //ends whilesocket
		return true;
	}
	protected function GotPacket(AstPacket $tAstPacket){
		//echo $tAstPacket->ToString();
		return true;
		//Do not put functionality here. Override in subcalss
	}


}
class AstClientConnection extends AstConnection {

        function Login($Username, $Password, $ServerIP, $Port){
		$this->mCounter =0;
                $apd = new AstPacketData();
		$apd->AddKVPair("Action", "login");
                $apd->AddKVPair("Username", $Username);
                $apd->AddKVPair("Secret", $Password);
                $apd->AddKVPair("Events", "on");
		$this->mCounter++ ;
                $apd->AddKVPair("ActionID", $this->mCounter);

                $ap = new AstPacket();
                $ap->SetAstPacketType("Action");
                $ap->SetAstPacketData($apd);
                if($this->mSocket){
                        $this->Logoff();
                }
		//echo "about call Connect function\r\n";
                if($this->Connect($ServerIP,$Port,"TCP")){
			//echo "Connect Passed .. \r\n";
                        if(!$dmy=socket_read($this->mSocket, 2048)){
				echo "Socket Cannot Read ...\r\n";
                                return false;
                        }
			//echo "About to call Send Packet ...\r\n";
                        $this->SendPacket($ap);
			return true;
                }else{
                        echo "cannot connect \r\n";
			return false;
                }
        }
        function Logoff(){
		echo "Logoff Called from somewhere ...";
                socket_close($this->mSocket);
        }
	function GetResponse($tActionID){
                $tAstPacket = new AstPacket();
                $tAstPacketData = new AstPacketData();
		$gettingpacket = true;

                while($this->mSocket && $gettingpacket){
                        if(!$rbuff=socket_read($this->mSocket, 5038)){
                                return null;
                        }
                        //echo "receive buff=$rbuff \r\n";
                        $arrbuff = explode("\r\n", $rbuff);
                        //print_r($arrbuff);
                        $dmy=array_pop($arrbuff);
                        foreach($arrbuff as $tline){
                                if(!strpos($tline,":")){
                                        $tAstPacket->SetAstPacketData($tAstPacketData);
					if(($tAstPacket->GetAstPacketType() == "Response:") && ($tAstPacket->GetActionID() ==$tActionID)){
						$gettingpacket = false;
						return $tAstPacket;
					}
                                        $tAstPacket = new AstPacket();
                                        $tAstPacketData = new AstPacketData();
                                        continue;
                                } //if ends here
                                //echo "Line is = $tline \r\n";
                                list($tKey,$tValue) = explode(":", $tline);
                                //echo "Key=$tKey and value=$tValue \r\n";
                                if($tKey=="Action" or $tKey=="Event" or $tKey=="Response"){
                                        if($tAstPacket->GetAstPacketType() == ""){
                                                //echo "Setting packet type to = $tKey \r\n";
                                                $tAstPacket->SetAstPacketType($tKey);
                                        }else {
                                                echo "Malformed Packet Discarding ...\r\n";
                                                echo $tAstPacket->GetAstPacketType() ."\r\n";
                                                echo "$tKey  $tValue \r\n";
                                                $tAstPacket = new AstPacket();
                                                $tAstPacketData = new AstPacketData();
                                                continue 2;
                                        } //if $tAstPacket ends
                                } //if $tKey ends
                                $tAstPacketData->AddKVPair($tKey, $tValue);
                        } //foreach ends
                } //ends whilegettingpacket
                return true;
        }
	function Cmd($command){
		$this->mCounter++ ;
		$ap = new AstPacket();
		$apd = new AstPacketData();
                $apd->AddKVPair("Action", "COMMAND");
                $apd->AddKVPair("ActionID", $this->mCounter);
                $apd->AddKVPair("command", $command);
		$ap->SetAstPacketType("Action");
		$ap->SetAstPacketData($apd);
		$this->SendPacket($ap);
		return $this->GetResponse($this->mCounter);
	}
	function GetConfig($file){
		$this->mCounter++ ;
		$ap = new AstPacket();
		$apd = new AstPacketData();
                $apd->AddKVPair("Action", "GetConfig");
                $apd->AddKVPair("ActionID", $this->mCounter);
                $apd->AddKVPair("FileName", $file);
		$ap->SetAstPacketType("Action");
		$ap->SetAstPacketData($apd);
		$this->SendPacket($ap);
		return $this->GetResponse($this->mCounter);
	}
	function Dial($Aparty, $Bparty, $Priority=1, $Timeout=30000, $Context="Default"){
		$this->mCounter++ ;
                $ap = new AstPacket();
                $apd = new AstPacketData();
                $apd->AddKVPair("Action", "originate");
                $apd->AddKVPair("ActionID", $this->mCounter);
                $apd->AddKVPair("Channel", $Aparty);
                $apd->AddKVPair("Context", $Context);
                $apd->AddKVPair("Exten", $Bparty);
                $apd->AddKVPair("Priority", $Priority);
                $apd->AddKVPair("Timeout", $Timeout);
		$ap->SetAstPacketType("Action");
                $ap->SetAstPacketData($apd);
                $this->SendPacket($ap);
                return $this->GetResponse($this->mCounter);
	}
	function GotEvent(AstPacket $Event, $EventType){
		return true;
		//Do not add lines here, just override in subclass
	}
	function EventsOn(){
		$this->mCounter++ ;
		$ap = new AstPacket();
                $apd = new AstPacketData();
                $apd->AddKVPair("Action", "EVENTS");
                $apd->AddKVPair("EVENTMASK", "ON");
		$apd->AddKVPair("ActionID", $this->mCounter);
		$ap->SetAstPacketType("Action");
		$ap->SetAstPacketData($apd);
		$this->SendPacket($ap);
	}
	function EventsOff(){
                $this->mCounter++ ;
                $ap = new AstPacket();
                $apd = new AstPacketData();
                $apd->AddKVPair("Action", "EVENTS");
                $apd->AddKVPair("EVENTMASK", "OFF");
                $apd->AddKVPair("ActionID", $this->mCounter);
                $ap->SetAstPacketType("Action");
                $ap->SetAstPacketData($apd);
                $this->SendPacket($ap);
        }

}
class AstSrvConnection extends AstConnection {

        function Listen($SrvPort, $ProtoType){

        }
}
?>
