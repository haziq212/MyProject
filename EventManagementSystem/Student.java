import java.io.FileWriter;

import javax.swing.JOptionPane;


public class Student extends Person{
    protected int StudentNumber;
    protected String Course;
    protected char Part;
    protected char Class;
    protected static String column[] = {"Student Number","Name","IC Number","Course","Phone Number","Age","Gender","Part","Class"};
    protected static String columnChoice =  "1. Student Number" +
                                            "\n2. Name" +
                                            "\n3. IC Number" +
                                            "\n4. Course" +
                                            "\n5. Phone Number" +
                                            "\n6. Age" + 
                                            "\n7. Gender" +
                                            "\n8. Part" +
                                            "\n9. Class";
                                            
    protected static int StudentColumnWidth[] = {4,300,20,10,20,10,10,5,14};

    Student(){}

    public void setStudentNumber(int temp){this.StudentNumber = temp;}
    public void setCourse(String temp){this.Course = temp;}
    public void setPart(char temp){this.Part = temp;}
    public void setClass(char temp){this.Class = temp;}
    
    public String getCourse(){return this.Course;}
    public String getClass1(){return this.Course + this.Part + this.Class;}
    public char getClass2(){return this.Class;}
    public char getPart(){return this.Part;}
    public int getStudentNumber(){return this.StudentNumber;}
    //NOT COMPLETED
    public static void alterStudents(){
        String fInput = JOptionPane.showInputDialog("Enter Student ID : ");
        if(fInput == null)return;
        int stdNum = Integer.parseInt(fInput);
        Student alterStud = find(stdNum);
        if(alterStud == null)return;
    }

    public static Student find(int stdNum){
        int low = 0;
        int high = Server.StudentList.size() - 1;
        int mid = (high + low )/2;
        while(high >= low){
            Student stud = Server.StudentList.get(mid);
            int currNumber = stud.getStudentNumber();
            if( currNumber == stdNum)return stud;
            else if(currNumber > stdNum)high = mid - 1;
            else low = mid + 1;
            mid = (high + low)/2;
        }
        return null;
    }

    public static void DisplayStudent(){
        int sortCol = -1;
        char sortOrder = '0';
        String aj = JOptionPane.showInputDialog("Do you want to sort (Y/n) : ");
        if(aj == null)return;
        String sortOrNot = aj.toUpperCase();
        String[][] data = new String[Server.StudentList.size()][column.length];
        fill2DArr(data,Server.StudentList);
        if(sortOrNot.charAt(0) == 'Y'){
            String temp = JOptionPane.showInputDialog(columnChoice + "\nEnter Number : ");
            if(temp == null)return;
            sortCol = Integer.parseInt(temp);
            if(sortCol < 1 || sortCol > 9)return;
            sortCol -= 1;
            temp = JOptionPane.showInputDialog("Ascending or Descending ? (A/d) : ").toUpperCase();
            if(temp == null)return;
            sortOrder = temp.charAt(0);
        }
        Auxiliary.CreateTable(sortCol,sortOrder, data, column, StudentColumnWidth,"STUDENT RECORD",30);
    }



    public static void fill2DArr(String[][] data,ArrayList<Student> arr){
        for(int i = 0; i < arr.size();i++){
                Student temp = arr.get(i);
                data[i][0] = String.valueOf(temp.getStudentNumber());
                data[i][1] = temp.getName();
                data[i][2] = temp.getICNumber();
                data[i][3] = temp.getCourse();
                data[i][4] = temp.getContactNumber();
                data[i][5] = String.valueOf(temp.getAge());
                data[i][6] = (temp.getGender() == 'M' ? "Male" : "Female") ;
                data[i][7] = temp.getPart() + "";
                data[i][8] = temp.getClass1();
        }
    }

    
    public static void Search(){
        ArrayList<Student> searchResult = new ArrayList<>();
        char opt;
        boolean found = false;
        String temp = JOptionPane.showInputDialog("Search By : \n" + columnChoice + "\nEnter Number");
        if(temp == null)return;
        opt = temp.charAt(0);
        String key =   JOptionPane.showInputDialog("Enter Keyword : ");
        if(key == null)return;
        key = "(.*)" + key + "(.*)";
        for (int i = 0; i < Server.StudentList.size(); i++){
            Student temp1 = Server.StudentList.get(i);
            switch (opt) {
                case '1':found = String.valueOf(temp1.getStudentNumber()).matches(key);break;
                case '2':found = temp1.getName().matches(key);break;
                case '3':found = temp1.getICNumber().matches(key);break;
                case '4':found = temp1.getCourse().matches(key);break;
                case '5':found = temp1.getContactNumber().matches(key);break;
                case '6':found = String.valueOf(temp1.getAge()).matches(key);break;
                case '7':found = (temp1.getGender() == 'M' ? "Male" : "Female").matches(key);break;
                case '8':found = (temp1.getPart() + "").matches(key);break;
                case '9':found = temp1.getClass1().matches(key);break;
                
                default:found = String.valueOf(temp1.getStudentNumber()).matches(key);break;
            }
            if(found){
                searchResult.add(temp1);
                found = false;
            }
        }
        String[][] data = new String[searchResult.size()][column.length];
        fill2DArr(data, searchResult);
        Auxiliary.CreateTable(0, 'A', data, column, StudentColumnWidth, "Search Result", 30);
    }

    public String toString(){
        //NUR NATASYA BINTI IMRAN;0199994445;011023027777;F;21;2019748563;BA119;5;B
        return this.getName() + ";" + this.getContactNumber() + ";" + this.getICNumber() + ";" + this.getGender() + ";" + this.getAge() + 
        ";" + this.getStudentNumber() + ";" + this.getCourse() + ";" + this.getPart() + ";" +  this.getClass2();
    }

    public static int find1(int stdNum){
        int low = 0;
        int high = Server.StudentList.size() - 1;
        int mid = (high + low )/2;
        while(high >= low){
            Student stud = Server.StudentList.get(mid);
            int currNumber = stud.getStudentNumber();
            if( currNumber == stdNum)return mid;
            else if(currNumber > stdNum)high = mid - 1;
            else low = mid + 1;
            mid = (high + low)/2;
        }
        return -1;
    }

    public static  void RemStudent(){
        String studNum = JOptionPane.showInputDialog(null,"Enter Student Number : ");
        if(studNum == null || !Server.isInteger(studNum))return;
        int indexRem = Student.find1(Integer.parseInt(studNum));
        if(indexRem == -1){
            JOptionPane.showMessageDialog(null,"No Student with that Number");
            return;
        }
        for(int i = 0; i < Server.ClubList.size();i++){
            Club kelab = Server.ClubList.get(i);
            int indexrem2 = kelab.findMember(Integer.parseInt(studNum));
            System.out.println(kelab.getClubName() + " " + indexrem2);
            if(indexrem2 != -1){
                kelab.getClubStudents().remove(indexrem2);
            }
        }
        Server.StudentList.remove(indexRem);
        JOptionPane.showMessageDialog(null,"Successfully removed !");
        StringBuilder strBuild = new StringBuilder();
        for(int i = 0;i < Server.StudentList.size();i++){
            Student temp123 = Server.StudentList.get(i);
            strBuild.append(temp123.toString() + "\n");
        }
        String isiStudent = strBuild.toString();
        try {
            FileWriter tulis1 = new FileWriter("Student.txt");
            tulis1.write(isiStudent);
            tulis1.close();
        } catch (Exception asd) {
        }
        StringBuilder strBuild1 = new StringBuilder();
        for (int i = 0; i < Server.ClubList.size(); i++) {
            Club kelab1 = Server.ClubList.get(i);
            for (int j = 0; j < kelab1.getClubStudents().size(); j++) {
                strBuild1.append(kelab1.getClubID() + ";" + kelab1.getClubStudents().get(j).getStudentNumber() + "\n");
            }
        }
        String isiClub_Student = strBuild1.toString();
        try {
            FileWriter tulis1 = new FileWriter("Club_Student.txt");
            tulis1.write(isiClub_Student);
            tulis1.close();
        } catch (Exception asd) {
        }                
    }
}

    
