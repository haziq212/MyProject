import java.lang.reflect.Array;

import javax.swing.*;
public class Staff extends Person{
    protected int StaffNumber;
    protected double StaffSalary;
    protected String user;
    protected String pass;
    protected static String column[] = {"Staff Number","IC Number","Name","Contact Number","Staff Salary","Gender","Age"};
    protected static String column1[] = {"Staff Number","IC Number","Name","Contact Number","Staff Salary","Gender","Age","UserName","Password"};
    protected static String columnChoice =  "1. Staff Number" +
                                            "\n2. IC Number" +
                                            "\n3. Name" +
                                            "\n4. Contact Number" +
                                            "\n5. Staff Salary" +
                                            "\n6. Gender" + 
                                            "\n7. Age";
    protected static int StaffColumnWidth[] = {4,20,300,10,10,3,3};
    Staff(){}
    
    
    
    public int getStaffNumber() {return this.StaffNumber;}
    public double getStaffSalary() {return this.StaffSalary;}
    public String getUser(){return this.user;}
    public String getPass(){return this.pass;}
    public double calcSalary(){return this.StaffSalary * 12.0;}


    public void setStaffNumber(int temp){this.StaffNumber = temp;}
    public void setStaffSalary(double temp){this.StaffSalary = temp;}
    public void setUser(String temp){this.user = temp;}
    public void setPass(String temp){this.pass = temp;}

    public static void DisplayStaff(){
        int sortCol = -1;
        char sortOrder = '0';
        String sortOrNot = JOptionPane.showInputDialog("Do you want to sort (Y/n) : ").toUpperCase();
        if(sortOrNot == null)return;
        String[][] data = new String[Server.StaffList.size()][column.length];
        fill2DArr(data,Server.StaffList);
        if(sortOrNot.charAt(0) == 'Y'){
            
            String temp = JOptionPane.showInputDialog(columnChoice + "\nEnter Number : ");
            if(temp == null)return;
            sortCol = Integer.parseInt(temp);
            if(sortCol < 1 || sortCol > 7)return;
            sortCol -= 1;
            temp = JOptionPane.showInputDialog("Ascending or Descending ? (A/d) : ").toUpperCase();
            if(temp == null)return;
            sortOrder = temp.charAt(0);
        }
        Auxiliary.CreateTable(sortCol,sortOrder, data, column, StaffColumnWidth,"Staff Record",30);
    }
    public static void Search(){
        ArrayList<Staff> searchResult = new ArrayList<>();
        char opt;
        boolean found = false;
        String temp = JOptionPane.showInputDialog("Search By : \n" + columnChoice + "\nEnter Number");
        if(temp == null)return;
        opt = temp.charAt(0);
        String key =   JOptionPane.showInputDialog("Enter Keyword : ");
        if(key == null)return;
        key = "(.*)" + key + "(.*)";
        for (int i = 0; i < Server.StaffList.size(); i++){
            Staff temp1 = Server.StaffList.get(i);
            switch (opt) {
    // {"Staff Number","IC Number","Name","Contact Number","Staff Salary","Gender","Age"};
                case '1':found = String.valueOf(temp1.getStaffNumber()).matches(key);break;
                case '2':found = temp1.getICNumber().matches(key);break;
                case '3':found = temp1.getName().matches(key);break;
                case '4':found = temp1.getContactNumber().matches(key);break;
                case '5':found = String.valueOf(temp1.getStaffSalary()).matches(key);break;
                case '6':found = (temp1.getGender() == 'M' ? "Male" : "Female").matches(key);break;
                case '7':found = String.valueOf(temp1.getAge()).matches(key);break;                
                default:found = String.valueOf(temp1.getStaffNumber()).matches(key);break;
            }
            if(found){
                searchResult.add(temp1);
                found = false;
            }
        }
        String[][] data = new String[searchResult.size()][column.length];
        fill2DArr(data, searchResult);
        Auxiliary.CreateTable(0, 'A', data, column, StaffColumnWidth, "Search Result", 30);
    }



    public static void fill2DArr(String[][] data,ArrayList<Staff> arr) {
    for (int i = 0; i < arr.size(); i++) {
        Staff temp = arr.get(i);
        data[i][0] = String.valueOf(temp.getStaffNumber());
        data[i][1] = temp.getICNumber();
        data[i][2] = temp.getName();
        data[i][3] = temp.getContactNumber();
        data[i][4] = String.valueOf(temp.getStaffSalary());
        data[i][5] = temp.getGender() == 'M' ? "Male" : "Female" ;
        data[i][6] = String.valueOf(temp.getAge());
    }

        

    }

    

    public static Staff find(int stfNum){
        int low = 0;
        int high = Server.StaffList.size() - 1;
        int mid = (high + low )/2;
        while(high >= low){
            Staff stf = Server.StaffList.get(mid);
            int currNumber = stf.getStaffNumber();
            if( currNumber == stfNum)return stf;
            else if(currNumber > stfNum)high = mid - 1;
            else low = mid + 1;
            mid = (high + low)/2;
        }
        return null;
    }

    public static int find1(int stfNum){
        int low = 0;
        int high = Server.StaffList.size() - 1;
        int mid = (high + low )/2;
        while(high >= low){
            Staff stf = Server.StaffList.get(mid);
            int currNumber = stf.getStaffNumber();
            if( currNumber == stfNum)return mid;
            else if(currNumber > stfNum)high = mid - 1;
            else low = mid + 1;
            mid = (high + low)/2;
        }
        return -1;
    }
    
    public String toString(){
//{"Staff Number","IC Number","Name","Contact Number","Staff Salary","Gender","Age"};
//ADAM RAFIE;0192531197;030611010337;M;19;123456;2500;admin;admin

        return this.getName() + ";" + 
        this.getContactNumber() + ";" + this.getICNumber() + ";" + 
        this.getGender() + ";" + this.getAge() + ";" 
        + this.getStaffNumber() + ";" + this.getStaffSalary() + 
        ";" + this.getUser() + ";" + this.getPass();
    }
}
    
    