

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.InputStream;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Random;
import java.util.concurrent.atomic.AtomicBoolean;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.OutputKeys;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerConfigurationException;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.TransformerFactoryConfigurationError;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;

import org.apache.commons.math3.distribution.EnumeratedIntegerDistribution;
import org.apache.commons.math3.distribution.ExponentialDistribution;
import org.apache.commons.math3.random.GaussianRandomGenerator;
import org.apache.commons.math3.random.JDKRandomGenerator;
import org.apache.commons.math3.random.RandomGenerator;
import org.w3c.dom.Document;
import org.w3c.dom.Element;




public class MachineSim {
	public static int q = 1;             	//vary Speed
	public static int simMonth = 1;              	//months of Operation
	static int simNo = 10;   				//no.of times of simulation
	public static int time = 720; 				//hours in a month
	static double prevInt=500;				//Preventive Maintenance Interval
	public Thread T1,T2,T3;
	public static double rate_Jobarrival=1;    //per hour
	static int size_random = 8; //Number of job types
	int[] quantity={1,10,12,15,3,16,4,5};
	int[] totalTimeArray = {1,1,1,1,1,1,1,1};
	String resultXML;
	public ArrayList<Component> comp_arr; //Arraylist of components
	static int minTTFComp; //Component with minimum TTF
    public int cm=0,pm=0,counter=0;
	public double cmDowntime=0,pmDowntime=0;
	double totalDowntime=0;
	int jobCount=0;
	double cmCost=0;
	double pmCost=0;
	double TECcm = 0;
	double TECpm = 0;
	public static int lpCost = 80;    // C lp   lost prod. cost  per job
	public static int labCost = 500;    // C lc    labour cost  per hour
	public static int rejCost = 500;     // cost of rejsction per job
	public static double logdelay = 0.2; // MCMDT
	public static double RPR = 0.3;      // reduced prod. rate
	public static double IRR = 0.3;     // Increased Rejection rate
	public static double splagTime = 4;  // slow productivity lag time t fc3
	public static double qdlagTime = 4;  //Quality defect lag time t fc2
	public static double dfact = 0.1;   // rate r
	public static double PV =0;
	long availabilityTime =0;
	final AtomicBoolean pmFailed = new AtomicBoolean(false);
	final AtomicBoolean cmFailed = new AtomicBoolean(false);
	double mcFC1 = 0;
	double mcFC2 = 0;
	double mcFC3 = 0;
	int probP1=0;
	int probP2=0;
	int probP3=0;
	public Object lock; 
	public static DecimalFormat df0 = new DecimalFormat("####0");
    public static DecimalFormat df2 = new DecimalFormat("####0.00");
	MachineSim(ArrayList<Component> arrayList){
		lock = new Object();
		comp_arr = arrayList;
		Runnable compFailure = new compFail();
		T1 = new Thread(compFailure);
		Runnable pmthread = new pmThread();
		T2 = new Thread(pmthread);
		Runnable jobThread = new jobThread();
		T3 = new Thread(jobThread);
		try {
			T1.join();
			T2.join();
			T3.join();
		System.out.println("done");
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
		
	}
	public boolean isAlive(){
		return T1.isAlive()||T2.isAlive()||T3.isAlive(); 
	}
	public void startSimulation(){
		T1.start();
		T2.start();
		T3.start();
		System.out.println("Machine starts");
	}
	int counter2=0;
	public class jobThread implements Runnable{

		@Override
		public void run() {
			int[] u_rnd=runif(size_random,quantity);
			 
			 while(counter2 != simNo){
				long t4 = System.currentTimeMillis();
				while(System.currentTimeMillis()-t4<(time*simMonth)) {
					try{
						if(jobCount%size_random == 0)
							u_rnd = runif(size_random,quantity);
						double start = System.currentTimeMillis(); 
						Thread.sleep((long)(totalTimeArray[u_rnd[jobCount%size_random]]));	
						jobCount++;
						availabilityTime+=System.currentTimeMillis() - start;
					}
					catch(InterruptedException e5){
						synchronized(lock){
							try{
							if(pmFailed.get()){
								double pmTTR =normalRandom(comp_arr.get(minTTFComp).pmMu,comp_arr.get(minTTFComp).pmSigma);
								System.out.println("Preventive Maintenance for TTR "+ df2.format(pmTTR) + "hr.");
									if((long)(pmTTR*q) >0)
										lock.wait((long)(pmTTR*q));
										
									pm++;
									//increment downtime
									comp_arr.get(minTTFComp).compDowntime += pmTTR;
									 pmCost = pmCost + comp_arr.get(0).pmRC;
									pmDowntime += pmTTR;
									//Preventive Maintenance repair	
									//Type 1 Restoration: restoring all damages from start
									for(int tmp=0;tmp<comp_arr.size();tmp++){
										double initial = comp_arr.get(tmp).inage;
										comp_arr.get(tmp).inage = (1-comp_arr.get(tmp).pmRF)*(comp_arr.get(tmp).vartimeage+initial);
										
										comp_arr.get(tmp).TTF = weibull(comp_arr.get(tmp).beta,comp_arr.get(tmp).eta,comp_arr.get(tmp).inage);
										comp_arr.get(tmp).vartimeage = prevInt;	
									}
									pmFailed.set(false);
							}
							else if(cmFailed.get()) {
							double cmTTR=normalRandom(comp_arr.get(minTTFComp).cmMu,comp_arr.get(minTTFComp).cmSigma);
							System.out.println("Component Failed. Corrective Maintenance for TTR: "+df2.format(cmTTR)+" hr.");
							if((long)(cmTTR*q)>0)
								lock.wait((long)(cmTTR*q));
							System.out.println("Machine repaired after corrective maintainance");
							//Calculate Cost
							cmCost = cmCost + comp_arr.get(minTTFComp).cmRC;
							double FC1 = ((cmTTR)* ((rate_Jobarrival*lpCost) +labCost))+comp_arr.get(minTTFComp).cmRC;
							double FC2 =  (rate_Jobarrival*RPR*qdlagTime*lpCost) +FC1;
							double FC3 = (rate_Jobarrival*IRR*splagTime*rejCost) +FC1;
							int m1 = failureMode(comp_arr.get(minTTFComp).p1,comp_arr.get(minTTFComp).p2,comp_arr.get(minTTFComp).p3);
							switch (m1){
							case 1:
								TECcm = TECcm + FC1 ;
								probP1++;
								comp_arr.get(minTTFComp).componentFC1=+FC1;
								mcFC1=+FC1;
								break;
							case 2:
								if((long)qdlagTime>0)
									lock.wait((long)qdlagTime);
								TECcm = TECcm+FC2;
								probP2++;
								comp_arr.get(minTTFComp).componentFC2=+FC2;
								mcFC2=+FC2;
								break;
							case 3:
								if((long)splagTime>0)
									lock.wait((long)splagTime);
								TECcm = TECcm+FC3;
								probP3++;
								comp_arr.get(minTTFComp).componentFC3=+FC3;
								mcFC3=+FC3;
								break;
							}
							
							
							comp_arr.get(minTTFComp).compDowntime += cmTTR; //Increment of component downtime 
							cmDowntime += cmTTR; //Increment total downtime
							comp_arr.get(minTTFComp).vartimeage = comp_arr.get(minTTFComp).vartimeage - comp_arr.get(minTTFComp).TTF - cmTTR;
							update_comp_inage(minTTFComp,failureTime);
							minTTFComp=findMin(comp_arr);
							cm++;
							System.out.println("CM "+ cm);
							System.out.println("");
							cmFailed.set(false);
							}	
						
						}catch(InterruptedException e){			
						}
						}
						
						}
					
				}
				counter2++;
				
			 
			 }
			 try {
				T1.join();
			 } catch (InterruptedException e) {
			}
			 try
			 {
				 T2.join();
			 }
			 catch (InterruptedException e){
			
			 }
			 
			 for(Component c : comp_arr){
					totalDowntime += c.compDowntime;
				}
			 	
				
				System.out.println("Machine Stops");
				System.out.println("No. of Preventive Maintenance is "+ pm/counter2);
				System.out.println("No. of Corrective Maintenance is "+ cm/counter2);
				System.out.println("CM downtime is "+ cmDowntime/counter2 + "hr");
				System.out.println("PM downtime is "+ pmDowntime/counter2 + "hr");
				System.out.println("Total downtime is "+ totalDowntime/counter2+ "hr");
				System.out.println("JobCount is "+jobCount/counter2);
				System.out.println("Availability time "+ availabilityTime/counter2+"hr");
				generateXML();
			
		}
		
	}

	double failureTime;
	public class compFail implements Runnable {
		@Override
			public void run() 
			{
				go();
			}
			  void go(){ 
				minTTFComp=findMin(comp_arr);
				while(counter != simNo){
				
				long t4 = System.currentTimeMillis();
				while(System.currentTimeMillis()-t4<(time*simMonth)) {
					
			try{
				//while(cmFailed.get() || pmFailed.get());
				failureTime = comp_arr.get(minTTFComp).TTF;
				System.out.println("Next failure after = " + df2.format(failureTime)+ "hr.");
				System.out.println("Component age is "+ comp_arr.get(minTTFComp).inage);
				Thread.sleep((long)(failureTime*q));
				cmFailed.set(true);	
				T3.interrupt(); //Interrupt job
				}
				
				catch (InterruptedException e5) {
					
				}
				}
				counter++;
				System.out.println("Simulation Completed is "+counter);
				for(int tmp=0;tmp<comp_arr.size();tmp++){
					comp_arr.get(tmp).inage=0;
					comp_arr.get(tmp).TTF=weibull(comp_arr.get(tmp).beta,comp_arr.get(tmp).eta,comp_arr.get(tmp).inage);
					comp_arr.get(tmp).vartimeage = prevInt;
				}
				}
				
				
				}
			
		}
	
	
	 int counter1=0;
	 public class pmThread implements Runnable{
			public void run(){
				
				
				while(counter1 != simNo){
					
					long t4 = System.currentTimeMillis();
					while(System.currentTimeMillis()-t4<(time*simMonth)) {
					try {
					//while(cmFailed.get() || pmFailed.get());
					Thread.sleep((long)(prevInt*q));
					pmFailed.set(true);
					T3.interrupt();
					
					}
				
					catch (InterruptedException e) {

					}
					}
					counter1++;
				} 
			}
		}
	 
	 public static double normalRandom(double mean, double sd)				
		{
		RandomGenerator rg = new JDKRandomGenerator();
		GaussianRandomGenerator g= new GaussianRandomGenerator(rg);	
		double a=(double) (mean+g.nextNormalizedDouble()*sd);
		return a;
		}
		
		public static int findMin(ArrayList<Component> ArrL){ //returns index of component with minimum TTF
			int IndMin=0;
			for(int ArrLSize=0;ArrLSize<ArrL.size();ArrLSize++){
				if(ArrL.get(IndMin).TTF>ArrL.get(ArrLSize).TTF){
					IndMin=ArrLSize;
				}
			}
			for(int ArrLSize=0;ArrLSize<ArrL.size();ArrLSize++){
				if(ArrLSize!=IndMin){
					ArrL.get(ArrLSize).TTF=ArrL.get(ArrLSize).TTF-ArrL.get(IndMin).TTF;
				}
			}
			return IndMin;
		}
	
		 void update_comp_inage(int minTTFComp, double TOF) {
			double initial =comp_arr.get(minTTFComp).inage;
			
			comp_arr.get(minTTFComp).inage = ((1-comp_arr.get(minTTFComp).cmRF1)*comp_arr.get(minTTFComp).TTF);
			comp_arr.get(minTTFComp).inage=comp_arr.get(minTTFComp).inage + initial;
		
			comp_arr.get(minTTFComp).TTF=weibull(comp_arr.get(minTTFComp).beta,comp_arr.get(minTTFComp).eta,comp_arr.get(minTTFComp).inage);
		}	
		public static double weibull(double p, double q, double agein) 
		{		
			//p beta and q eta 
			double t0 = agein;
			double b=Math.pow(t0, p);
			double a=Math.pow((1/q), p);
			Random x= new Random();
			return (Math.pow(b-((Math.log(1-x.nextDouble())/a)),(1/p)))-t0;
		}
		public static double[] rexp(double rate,int sizeArray)				//generate random number array following exponential distribution
		{
		ExponentialDistribution g=new ExponentialDistribution(rate);
		int i=0;
		double[] arr=new double[sizeArray];
		while(i<sizeArray){
			arr[i]=(double) g.sample();
			i++;
			}
		return arr;
		}

		public static int[] runif(int numSamples,int[] weights)				//generate random number(between 0 and 1) following discrete distribution of weights
		{
			int[] numsToGenerate = new int[] {0 ,1  , 2  ,  3,  4 ,  5,    6,  7 };
			
			int[] temp=weights;
			double sum=0.0;
			double[] discreteProbabilities=new double[numsToGenerate.length];
			int i;
			for(i=0;i<numsToGenerate.length;i++)
			{
				
				discreteProbabilities[i]=temp[i];
				sum+=temp[i];
			}
			for(i=0;i<numsToGenerate.length;i++)
			{
				discreteProbabilities[i]=discreteProbabilities[i]/sum;
			}

			EnumeratedIntegerDistribution distribution = 
			    new EnumeratedIntegerDistribution(numsToGenerate, discreteProbabilities);
			
			int[] samples = distribution.sample(numSamples);
			return samples;
		}


				
		public int failureMode(double p1,double p2,double p3){
			
		int[] numsToGenerate = {1,2,3};
		double[] discreteProbabilities = {p1,p2,p3};
			EnumeratedIntegerDistribution distribution = 
				    new EnumeratedIntegerDistribution(numsToGenerate, discreteProbabilities);
			
			return distribution.sample();
				
			}
		
		public class ThreadLock{
			public boolean pmFailed=false;
			public boolean cmFailed=false;
		}
		private void generateXML() {
			// TODO Auto-generated method stub
			
				 
				DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
				DocumentBuilder docBuilder;
				try {
					docBuilder = docFactory.newDocumentBuilder();
					// root elements
					Document doc = docBuilder.newDocument();
					Element rootElement = doc.createElement("result");
					doc.appendChild(rootElement);
					Element total_Downtime = doc.createElement("totalDowntime");
					total_Downtime.setTextContent(String.valueOf(totalDowntime/counter2));
					rootElement.appendChild(total_Downtime);
					Element cm_Downtime = doc.createElement("cmDowntime");
					cm_Downtime.setTextContent(String.valueOf(cmDowntime/counter2));
					rootElement.appendChild(cm_Downtime);
					Element pm_Downtime = doc.createElement("pmDowntime");
					pm_Downtime.setTextContent(String.valueOf(pmDowntime/counter2));
					rootElement.appendChild(pm_Downtime);
					Element cm_No = doc.createElement("cmNo");
					cm_No.setTextContent(String.valueOf(cm/counter2));
					rootElement.appendChild(cm_No);
					Element pm_No = doc.createElement("pmNo");
					pm_No.setTextContent(String.valueOf(pm/counter2));
					rootElement.appendChild(pm_No);
					for(int i=0;i<comp_arr.size();i++){
						Element comp_downtime = doc.createElement("comp_downtime");
						comp_downtime.setAttribute("id", String.valueOf(i));
						comp_downtime.setTextContent(String.valueOf(comp_arr.get(i).compDowntime/counter2));
						rootElement.appendChild(comp_downtime);
						Element comp_FC1 = doc.createElement("comp_FC1");
						comp_FC1.setAttribute("id", String.valueOf(i));
						comp_FC1.setTextContent(String.valueOf(comp_arr.get(i).componentFC1/counter2));
						rootElement.appendChild(comp_FC1);
						Element comp_FC2 = doc.createElement("comp_FC2");
						comp_FC2.setAttribute("id", String.valueOf(i));
						comp_FC2.setTextContent(String.valueOf(comp_arr.get(i).componentFC2/counter2));
						rootElement.appendChild(comp_FC2);
						Element comp_FC3 = doc.createElement("comp_FC3");
						comp_FC3.setAttribute("id", String.valueOf(i));
						comp_FC3.setTextContent(String.valueOf(comp_arr.get(i).componentFC3/counter2));
						rootElement.appendChild(comp_FC3);
					}
					 Transformer tf = TransformerFactory.newInstance().newTransformer();
					 tf.setOutputProperty(OutputKeys.ENCODING, "UTF-8");
					 tf.setOutputProperty(OutputKeys.INDENT, "yes");
					 ByteArrayOutputStream out = new ByteArrayOutputStream();
					 tf.transform(new DOMSource(doc), new StreamResult(out));
					resultXML = out.toString();
					
				} catch (ParserConfigurationException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}  catch (TransformerConfigurationException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				} catch (TransformerFactoryConfigurationError e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				} catch (TransformerException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}

				
				
			
		}
		public String getResult(){
			return resultXML;
		}
				
}
