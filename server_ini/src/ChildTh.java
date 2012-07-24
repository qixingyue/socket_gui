import java.io.*;
import java.net.*;

public class ChildTh implements Runnable {
	
	
	private Socket client;

	private String baseUrl ;
	
	public ChildTh(Socket client) {
		this.client = client;
		this.baseUrl = Server.baseUrl;
	}

	public void run() {
		try {
			System.out.println("client coming!\n");
			PrintWriter printer = new PrintWriter(this.client.getOutputStream());
			BufferedReader reader = new BufferedReader(new InputStreamReader(
					this.client.getInputStream()));
			String f = reader.readLine();
			String c = reader.readLine();
			Server.append("*************** Request from:"+this.client.getInetAddress().toString()+"*********************");
			Server.append("Receive:\n"+c.replace("><", ">\n<"));
			Server.append("\n");
			System.out.println("want get  " + f + ".xml command is \n"+ c.replace("><", ">\n<") +" \n from "
					+ this.client.getInetAddress().toString());
			HttpRequester requester = new HttpRequester();
			HttpRespons response= requester.sendGet(this.baseUrl + "index.php/xmlreturn/getxml/"+f);
			System.out.println(response.content);
			Server.append("Send:\n"+response.content+"\n");
			printer.println(response.content);
			printer.flush();
			printer.close();
			printer.close();
			this.client.close();
			System.out.println("client leaving!\n");
		} catch (Exception e) {
			e.printStackTrace();
			Server.append("error in the close the socket or the http can't be got!");
			System.out.println("error in the close the socket!");
		}
	}
}