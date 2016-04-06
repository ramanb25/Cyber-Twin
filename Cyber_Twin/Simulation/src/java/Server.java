import java.io.BufferedReader;
import java.io.IOException;
 
import javax.websocket.OnClose;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;
import java.io.File;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.StringWriter;
import java.net.Inet4Address;
import java.net.InetAddress;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.util.ArrayList;
import java.util.Enumeration;
import java.lang.Object;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;
import sun.misc.IOUtils;
 
/** 
 * @ServerEndpoint gives the relative name for the end point
 * This will be accessed via ws://localhost:8080/EchoChamber/echo
 * Where "localhost" is the address of the host,
 * "EchoChamber" is the name of the package
 * and "echo" is the address to access this class from the server
 */
@ServerEndpoint("/echo") 
public class Server {
    static ArrayList<Component> cl;
    /**
     * @OnOpen allows us to intercept the creation of a new session.
     * The session class allows us to send data to the user.
     * In the method onOpen, we'll let the user know that the handshake was 
     * successful.
     */
    @OnOpen
    public void onOpen(Session session){
        System.out.println(session.getId() + " has opened a connection"); 
        try {
            session.getBasicRemote().sendText("Connection Established");
        } catch (IOException ex) {
            ex.printStackTrace();
        }
    }
 
    /**
     * When a user sends a message to the server, this method will intercept the message
     * and allow us to react to it. For now the message is read as a String.
     */
    @OnMessage
    public void onMessage(String message, Session session) throws IOException{
        System.out.println("Message from " + session.getId() + ": " + message);
        cl =parseXML(); 
					MachineSim sim = new MachineSim(cl);
					//HttpResponse response = new HttpResponse(HttpStatus.OK);
					   sim.startSimulation();
					   while(sim.isAlive());
					 
                                            String response;
					   //response.addHeader("Content-type","text/xml");
					       response=sim.getResult();
                                              //InputStream in = /* your InputStream */;


                                               System.out.println("Message from " + session.getId() + ": " + response);
                                               
        try {
            session.getBasicRemote().sendText(response);
        } catch (IOException ex) {
            ex.printStackTrace();
        }
    }
 
    /**
     * The user closes the connection.
     * 
     * Note: you can't send messages to the client from this method
     */
    @OnClose
    public void onClose(Session session){
        System.out.println("Session " +session.getId()+" has ended");
    }
    
     public static String getIP(){
        String ipAddress = null;
        Enumeration<NetworkInterface> net = null;
        try {
            net = NetworkInterface.getNetworkInterfaces();
        } catch (SocketException e) {
            throw new RuntimeException(e);
        }

        while(net.hasMoreElements()){
            NetworkInterface element = net.nextElement();
            Enumeration<InetAddress> addresses = element.getInetAddresses();
            while (addresses.hasMoreElements()){
                InetAddress ip = addresses.nextElement();
                if (ip instanceof Inet4Address){

                    if (ip.isSiteLocalAddress()){

                        ipAddress = ip.getHostAddress();
                    }

                }

            }
        }
        return ipAddress;
    }
    

	private static ArrayList<Component> parseXML(){
		ArrayList<Component> comp_arr=new ArrayList<Component>();
		 DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
	        DocumentBuilder db = null;
	       
	        int i;
	    
	            try {
					db = dbf.newDocumentBuilder();
					Document doc = db.parse(new File("model.xml"));
					doc.getDocumentElement().normalize();
		            NodeList nodeList = doc.getElementsByTagName("component");
		            for(i = 0; i < 7; i++){
		       		 Element supplier = (Element) nodeList.item(i);
		       		 Double cmEta = Double.valueOf(supplier.getElementsByTagName("cmEta").item(0).getTextContent());
		       		Double cmBeta = Double.valueOf(supplier.getElementsByTagName("cmBeta").item(0).getTextContent());
		       		Double cmMu = Double.valueOf(supplier.getElementsByTagName("cmMu").item(0).getTextContent());
		       		Double cmSigma = Double.valueOf(supplier.getElementsByTagName("cmSigma").item(0).getTextContent());
		       		Double cmRF1 = Double.valueOf(supplier.getElementsByTagName("cmRF1").item(0).getTextContent());
		       		int cmRC = Double.valueOf(supplier.getElementsByTagName("cmRC").item(0).getTextContent()).intValue();
		       		Double pmMu = Double.valueOf(supplier.getElementsByTagName("pmMu").item(0).getTextContent());
		       		Double pmSigma = Double.valueOf(supplier.getElementsByTagName("pmSigma").item(0).getTextContent());
		       		Double pmRF = Double.valueOf(supplier.getElementsByTagName("pmRF").item(0).getTextContent());
		       		double inage = 0;
					double varage = 730;
					double nofailure = 0;
					double p1 = Double.valueOf(supplier.getElementsByTagName("p1").item(0).getTextContent());
					double p2 = Double.valueOf(supplier.getElementsByTagName("p2").item(0).getTextContent());
					double p3 = Double.valueOf(supplier.getElementsByTagName("p3").item(0).getTextContent());;
					double shiftFactor = Double.valueOf(supplier.getElementsByTagName("shiftFactor").item(0).getTextContent());;
					double compDown = 0;
					double compFC1 = 0;
					double compFC2 = 0;
					double compFC3 = 0;
					int pmRC = Double.valueOf(supplier.getElementsByTagName("pmRC").item(0).getTextContent()).intValue();
					Component comp = new Component(cmEta,cmBeta,cmMu,cmSigma,cmRF1,cmRC,pmMu,pmSigma,pmRF,pmRC,inage,varage,nofailure,p1,p2,p3,shiftFactor,compDown,compFC1,compFC2,compFC3);
		       		 comp_arr.add(comp);
		       		 
		       	 }
				} catch (SAXException | IOException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				catch (ParserConfigurationException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
	            return comp_arr;
	}
}