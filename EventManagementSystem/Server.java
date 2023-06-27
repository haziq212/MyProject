import java.io.*;
import java.util.NoSuchElementException;
import java.util.Scanner;
import java.util.StringTokenizer;

import javax.swing.JOptionPane;

/*
 * NOT DONE : 
 * 
 * 
 * 
 * 
 * 
 * Remove Events
 * 
 */
public class Server {
    static ArrayList<Student> StudentList = new ArrayList<Student>();
    static ArrayList<Staff> StaffList = new ArrayList<Staff>();
    static ArrayList<Club> ClubList = new ArrayList<Club>();
    public static void main(String[] args) {
        Initiate();
        
        Interface app = new Interface();
        app.setVisible(true);

        // Club kel = Club.findClub(1);
        // System.out.println(kel.ClubID);

        Club kel = ClubList.get(0);
        System.out.println(kel.findEvent(1233122));
    }
    
    public static void Initiate(){   
        //Fill Student ArrayList
        {
        try {
            File fail = new File("Student.txt");
            Scanner read = new Scanner(fail);
            while(read.hasNextLine()){
                StringTokenizer strToken = new StringTokenizer(read.nextLine(),";");
                Student temp = new Student();
                temp.setName(strToken.nextToken());
                temp.setContactNumber(strToken.nextToken());
                temp.setICNumber(strToken.nextToken());
                temp.setGender(strToken.nextToken().charAt(0));
                temp.setAge(Byte.parseByte(strToken.nextToken()));
                temp.setStudentNumber(Integer.parseInt(strToken.nextToken()));
                temp.setCourse(strToken.nextToken());
                temp.setPart(strToken.nextToken().charAt(0));
                temp.setClass(strToken.nextToken().charAt(0));
                StudentList.add(temp);
            }
            read.close();
        } catch (IOException e) {
            System.exit(0);
            // TODO: handle exception
        }
    }
        //Fill Staff ArrayList
        {
    try     {

            File fail = new File("Staff.txt");
            Scanner read = new Scanner(fail);
            while(read.hasNextLine()){
                StringTokenizer strToken = new StringTokenizer(read.nextLine(),";");
                Staff temp = new Staff();
                temp.setName(strToken.nextToken());
                temp.setContactNumber(strToken.nextToken());
                temp.setICNumber(strToken.nextToken());
                temp.setGender(strToken.nextToken().charAt(0));
                temp.setAge(Byte.parseByte(strToken.nextToken()));
                temp.setStaffNumber(Integer.parseInt(strToken.nextToken()));
                temp.setStaffSalary(Double.parseDouble(strToken.nextToken()));
                temp.setUser(strToken.nextToken());
                temp.setPass(strToken.nextToken());
                StaffList.add(temp);
            }
            read.close();
        } catch (IOException e) {

            System.exit(0);
            // TODO: handle exception
        }
        }
        //Fill Out Clubs
        {


            try {
                File fail = new File("Club.txt");
                Scanner read = new Scanner(fail);
                File fail2 = new File("Events.txt");
                Scanner read2 = new Scanner(fail2);
                File fail3 = new File("Club_Student.txt");
                Scanner read3 = new Scanner(fail3);
                File fail4 = new File("Club_Staff.txt");
                Scanner read4 = new Scanner(fail4);
                StringTokenizer strToken2;
                StringTokenizer strToken3;
                StringTokenizer strToken4;
                Events event;
                try{
                    strToken2 = new StringTokenizer(read2.nextLine(),";");
                    event = new Events();
                    event.setByClubID(Integer.parseInt(strToken2.nextToken()));
                    event.setEventID(Integer.parseInt(strToken2.nextToken()));
                    event.setEventName(strToken2.nextToken());
                    event.setEventDate(strToken2.nextToken());
                    event.setEventTime(strToken2.nextToken());
                    event.setEventDuration(Double.parseDouble(strToken2.nextToken()));
                    event.setEventBudget(Double.parseDouble(strToken2.nextToken()));
                }catch(NoSuchElementException a){
                    strToken2 = null;
                    event = null;
                }
                int clNum;
                int stNum;
                int clNum1;
                int stfNum;
                try{
                    strToken3 = new StringTokenizer(read3.nextLine(),";");
                    clNum = Integer.parseInt(strToken3.nextToken());
                    stNum = Integer.parseInt(strToken3.nextToken());


                }catch(NoSuchElementException e){
                    strToken3 = null;
                    clNum = -1;
                    stNum = -1;
                }

                try{
                    strToken4 = new StringTokenizer(read4.nextLine(),";");
                    clNum1 = Integer.parseInt(strToken4.nextToken());
                    stfNum = Integer.parseInt(strToken4.nextToken());


                }catch(NoSuchElementException e){
                    strToken3 = null;
                    clNum1 = -1;
                    stfNum = -1;
                }
                while(read.hasNextLine()){
                    StringTokenizer strToken = new StringTokenizer(read.nextLine(),";");
                    Club temp = new Club();
                    temp.setClubID(Integer.parseInt(strToken.nextToken()));
                    temp.setClubName(strToken.nextToken());
                    temp.setClubDescription(strToken.nextToken());
                    while(event != null && temp.getClubID() == event.getClubID()){
                        temp.ClubEvents.add(event);
                        // System.out.println(temp.getClubID() + " " + event.getClubID());
                        try {
                            event = new Events();
                            strToken2 = new StringTokenizer(read2.nextLine(),";");
                            event.setByClubID(Integer.parseInt(strToken2.nextToken()));
                            event.setEventID(Integer.parseInt(strToken2.nextToken()));
                            event.setEventName(strToken2.nextToken());
                            event.setEventDate(strToken2.nextToken());
                            event.setEventTime(strToken2.nextToken());
                            event.setEventDuration(Double.parseDouble(strToken2.nextToken()));
                            event.setEventBudget(Double.parseDouble(strToken2.nextToken()));        
                        } catch (NoSuchElementException w) {
                            strToken2 = null;
                            event = null;
                        }
                    }
                    
                    while(clNum == temp.getClubID()){
                        Student sttemp = Student.find(stNum);
                        if(sttemp != null){
                            temp.getClubStudents().add(sttemp);
                            // System.out.println(sttemp.getStudentNumber());
                            
                        }
                        try{
                            strToken3 = new StringTokenizer(read3.nextLine(),";");
                            clNum = Integer.parseInt(strToken3.nextToken());
                            stNum = Integer.parseInt(strToken3.nextToken());
                        }catch(NoSuchElementException e){
                            strToken3 = null;
                            clNum = -1;
                            stNum = -1;
                        }
                    }

                    while(clNum1 == temp.getClubID()){
                        Staff stftemp = Staff.find(stfNum);
                        if(stftemp != null){
                            temp.getClubStaff().add(stftemp);
                        }
                        try{
                            strToken4 = new StringTokenizer(read4.nextLine(),";");
                            clNum1 = Integer.parseInt(strToken4.nextToken());
                            stfNum = Integer.parseInt(strToken4.nextToken());
                        }catch(NoSuchElementException e){
                            strToken3 = null;
                            clNum1 = -1;
                            stfNum = -1;
                        }
                    }
                    
                    
                    ClubList.add(temp);
                    
                }
                read.close();
                read2.close();
                read3.close();

            } catch (IOException e) {
                System.exit(0);
                // TODO: handle exception
            }

        }
    
    }
    static boolean isInteger(String a){
        try {
            int b = Integer.parseInt(a);
        } catch (NumberFormatException e) {
            return false;
        }
        return true;
    }

    static boolean isDouble(String a){
        try {
            double b = Double.parseDouble(a);
        } catch (NumberFormatException e) {
            return false;
        }
        return true;
    }

    static boolean isByte(String a){
        try {
            byte b = Byte.parseByte(a);
        } catch (NumberFormatException e) {
            return false;
        }
        return true;
    }


}
