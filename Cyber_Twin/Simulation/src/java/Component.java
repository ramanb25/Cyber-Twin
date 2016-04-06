


public class Component
{
	double age_init;
	double beta;
	double eta;
	double TTF;
	double cmRF1;
	int cmRC;
	double inage;
	double cmMu ;
	double cmSigma ;
	double pmMu ;
	double pmSigma ;
	double pmRF;
	int pmRC;
	double vartimeage;
	double noFailure;
	double p1;
	double p2;
	double p3;
	double shiftFactor;
	double compDowntime;
	double componentFC1;
	double componentFC2;
	double componentFC3;
	
	public Component(double cmEta,double cmBeta,double cmMu,double cmSigma,double cmRF1,int cmRC,double pmMu,double pmSigma,double pmRF,int pmRC,double inage,double varage,double noFailure,double p1,double p2,double p3,double shiftFactor,double compDowntime,double componentFC1,double componentFC2,double componentFC3)
	{
		this.inage = inage;
		this.beta=cmBeta;
		this.eta=cmEta;
		this.age_init= MachineSim.weibull(beta, eta,this.inage);
		this.cmRF1=cmRF1;
		this.TTF=age_init;
		this.cmRC=cmRC;
		this.cmMu = cmMu;
		this.cmSigma = cmSigma;
		this.pmMu =pmMu;
		this.pmSigma =pmSigma;
		this.pmRF = pmRF;
		this.pmRC = pmRC;
		this.vartimeage = varage;
		this.noFailure = noFailure;
		this.p1 = p1;
		this.p2 = p2;
		this.p3 = p3;
		this.shiftFactor =shiftFactor ;
		this.compDowntime= compDowntime;
		this.componentFC1= componentFC1;
		this.componentFC2= componentFC2;
		this.componentFC3= componentFC3;
	}
	

}
