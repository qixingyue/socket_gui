import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.text.SimpleDateFormat;
import java.util.Date;

import ch.ubique.inieditor.IniEditor;

public class Server {
	
    public static String path ;
    
    public static File logFile ;

	public static String baseUrl = "";

	public static void main(String[] args) throws IOException {
		
		if(args.length!=1){
			System.out.println("Usage:java -jar server.jar inipath \n");
			return;
		}else{
			String inipath = args[0];
			IniEditor ini = new IniEditor();
			try {
				ini.load(inipath);
				Server.baseUrl = ini.get("socket_server", "base_url");
				System.out.println("GET from " + Server.baseUrl);
				Server.path = ini.get("socket_server", "log_path");
				System.out.println("Logs write to" + Server.path);
			} catch (IOException e) {
				e.printStackTrace();
				return;
			}
		}
		
		SimpleDateFormat sf = new SimpleDateFormat("yyyy-MM-dd");
		Server.path += sf.format(new Date()).toString();
		try {
			Server.logFile= new File(Server.path);
			if(!Server.logFile.exists()) {
				Server.logFile.createNewFile();
			}
			Server.writeLine();
			Server.append("Started at " +(new Date()).toString());
		} catch (Exception e) {
			System.out.println("Dir not existed!\n");
			System.exit(0);
		}
		
		
		System.out.println("Server started !\n");
		ServerSocket server = new ServerSocket(5678);
		while (true) {
			Socket client = server.accept();
			ChildTh ct = new ChildTh(client);
			ct.run();
		}

	}
	
	public static void append(String content) {
		try {
			FileWriter writer = new FileWriter(Server.logFile,true);
			writer.append(content.toString()).append('\n');
			writer.flush();
			writer.close();
		} catch (IOException e) {
			System.out.println("Append Content Failed!\n");
		}
	}
	
	public static void writeLine() {
		Server.append("\n---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------\n");
	}
}
