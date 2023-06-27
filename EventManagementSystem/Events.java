
public class Events {
    protected int byClubID;
    protected int EventID;
    protected String EventName;
    protected String EventDate;// DD/MM/YYYY
    protected String EventTime;// XXXX - XXXX 24 Hour Format
    protected double EventDuration;// X Hours
    protected double EventBudget;
    public static String[] EventColumn = {"Club ID","Event ID","Event Name","Event Date","Event Time","Event Duration","Event Budget"};
    public static int[] EventColumnWidth = {10,10,30,10,10,10,10};
    Events(){}
    public void setByClubID(int temp){this.byClubID = temp;}
    public void setEventID(int temp){this.EventID =temp;}
    public void setEventDate(String temp){this.EventDate = temp;}
    public void setEventTime(String temp){this.EventTime = temp;}
    public void setEventName(String temp){this.EventName = temp;}
    public void setEventDuration(double temp){this.EventDuration =temp;}
    public void setEventBudget(double temp){this.EventBudget = temp;}


    public int getClubID(){return this.byClubID;}
    public int getEventID(){return this.EventID;}
    public String getEventDate(){return this.EventDate;}
    public String getEventTime(){return this.EventTime;}
    public String getEventName(){return this.EventName;}
    public double getEventDuration(){return this.EventDuration;}
    public double getEventBudget(){return this.EventBudget;}

    public String toString(){
        return this.getClubID() + ";" + this.getEventID() + ";" + this.getEventName()+ ";" + this.getEventDate()+ ";" + this.getEventTime()+ ";" + this.getEventDuration() + ";"+ this.getEventBudget();
    }


}
