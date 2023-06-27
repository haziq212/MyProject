import javax.swing.JOptionPane;
public class Club {
    protected int ClubID; 
    protected String ClubName;    
    protected String Description;    
    protected ArrayList<Student> ClubMembers = new ArrayList<>();
    protected ArrayList<Staff> ClubStaff = new ArrayList<>();
    protected ArrayList<Events> ClubEvents = new ArrayList<>();
    protected static String column[] = {"ClubID","Club Name", "Club Descriptions"};
    static String columnChoice =  "1. Club ID" + 
                            "\n2.Club Name" + 
                            "\n3. Club Descriptions";
    private static int ClubColumnWidth[] = {10,10,300};

    
    Club(){}
    public void setClubName(String temp){this.ClubName = temp;}
    public void setClubID(int temp){this.ClubID = temp;}
    public void setClubDescription(String temp){this.Description = temp;}
    public int getClubID(){return this.ClubID;}
    public String getClubName(){return this.ClubName;}
    public String getDescriptions(){return this.Description;}
    public ArrayList<Events> getClubEvents(){return this.ClubEvents;}
    public ArrayList<Student> getClubStudents(){return this.ClubMembers;}
    public ArrayList<Staff> getClubStaff(){return this.ClubStaff;}

    public static void DisplayClubs() {
        String data[][] = new String[Server.ClubList.size()][column.length];
        for(int i = 0; i < Server.ClubList.size();i++){
            Club temp = Server.ClubList.get(i);
            data[i][0] = String.valueOf(temp.getClubID());
            data[i][1] = temp.getClubName();
            data[i][2] = temp.getDescriptions();
        }
        Auxiliary.CreateTableClub(0, 'A', data, column, ClubColumnWidth, "Club");
    }

    public static void Search(){
        ArrayList<Club> searchResult = new ArrayList<>();
        char opt;
        boolean found = false;
        String temp = JOptionPane.showInputDialog("Search By : \n" + columnChoice + "\nEnter Number");
        if(temp == null)return;
        opt = temp.charAt(0);
        String key = JOptionPane.showInputDialog("Enter Keyword : ");
        if(key == null)return;
        key = "(.*)" + key + "(.*)";
        for (int i = 0; i < Server.ClubList.size(); i++){
            Club temp1 = Server.ClubList.get(i);
            switch (opt) {
                case '1':found =String.valueOf(temp1.getClubID()).matches(key);break;
                case '2':found =temp1.getClubName().matches(key);break;            
                default:found =temp1.getDescriptions().matches(key);break;
            }
            if(found){
                searchResult.add(temp1);
                found = false;
            }
        }
        String[][] data = new String[searchResult.size()][column.length];
        for(int i = 0; i < searchResult.size();i++){
            Club temp2 = searchResult.get(i);
            data[i][0] = String.valueOf(temp2.getClubID());
            data[i][1] = temp2.getClubName();
            data[i][2] = temp2.getDescriptions();
        }
        
        Auxiliary.CreateTableClub(0, 'A', data, column, ClubColumnWidth, "Search Result");
        }
    
    public int findMember(int stdNum){
        int low = 0;
        int high = this.getClubStudents().size() - 1;
        int mid = (low + high) /2;
        while(high >= low){
            Student stud = this.getClubStudents().get(mid);
            int stdNum2 = stud.getStudentNumber();

            if(stdNum2 == stdNum)return mid;
            else if(stdNum2 > stdNum) high = mid - 1;
            else low = mid + 1;

            mid = (low + high )/ 2;
        }
       return -1;
    }

    public int findStaff(int stdNum){
        int low = 0;
        int high = this.getClubStaff().size() - 1;
        int mid = (low + high) /2;
        while(high >= low){
            Staff stud = this.getClubStaff().get(mid);
            int stdNum2 = stud.getStaffNumber();
            if(stdNum2 == stdNum)return mid;
            else if(stdNum2 > stdNum) high = mid - 1;
            else low = mid + 1;
            mid = (low + high )/ 2;
        }
       return -1;
    }

    public static Club findClub(int clFind){
        int low = 0;
        int high = Server.ClubList.size() - 1;
        int mid = (low + high)/2;
        while(high >= low){
            Club namaKelab = Server.ClubList.get(mid);
            int testtest = namaKelab.getClubID();
            if(testtest == clFind)return namaKelab;
            else if(testtest > clFind)high = mid - 1;
            else low = mid + 1;
            mid = (low + high )/2;
        }
        return null;
    }

    public static int findClub1(int clFind){
        int low = 0;
        int high = Server.ClubList.size() - 1;
        int mid = (low + high)/2;
        while(high >= low){
            Club namaKelab = Server.ClubList.get(mid);
            int testtest = namaKelab.getClubID();
            if(testtest == clFind)return mid;
            else if(testtest > clFind)high = mid - 1;
            else low = mid + 1;
            mid = (low + high )/2;
        }
        return -1;
    }
    public String toString(){
        return this.getClubID()  + ";" + this.getClubName() + ";" +  this.getDescriptions();
    }

    public int findEvent(int eveid){
        int low = 0;
        int high = this.getClubEvents().size() - 1;
        int mid = (low + high)/2;
        while(high >= low){
            Events a = this.getClubEvents().get(mid);
            int a1 = a.getEventID();
            if(a1 == eveid)return mid;
            else if(a1 > eveid)high = mid - 1;
            else low = mid + 1;
            mid = (low + high )/2;
        }
        return -1;
    }
    public String toStringEvent(){
        String str = "";
        for (int i = 0; i < this.getClubEvents().size(); i++) {
            Events event = this.getClubEvents().get(i);
            str = str + event.toString() + "\n";
        }
        return str;
    }
    public void remEvent(){
        String cek = JOptionPane.showInputDialog(null, "Input Event ID : ");
        if(cek == null)return;
        int pos = this.findEvent(Integer.parseInt(cek));
        if(pos == -1)return;
        else this.getClubEvents().remove(pos);

    }
    public void remStaff(){
        String cek = JOptionPane.showInputDialog(null, "Input Staff ID : ");
        if(cek == null)return;
        int pos = this.findStaff(Integer.parseInt(cek));
        if(pos == -1){
            JOptionPane.showMessageDialog(null,"No Staff ID in this Club");
        }
        else
        this.getClubStaff().remove(pos);
    }
    public void remStudent(){
        String cek = JOptionPane.showInputDialog(null, "Input Student ID : ");
        if(cek == null)return;
        int pos = this.findMember(Integer.parseInt(cek));
        if(pos == -1){
            JOptionPane.showMessageDialog(null,"No Student ID in this Club");
        }
        else
        this.getClubStudents().remove(pos);
    }
    
    }
