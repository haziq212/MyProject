import java.util.UUID;
import java.util.Random;
public class GenerateData {
    public static void main(String[] args) {
        String[] course = {"AM110","CS110","CS111","BA111","BA119"};
        System.out.print("Generate data ? :" );
        int data = new  java.util.Scanner(System.in).nextInt();
        System.out.println("StudNumber Name                 IC Number    Course PhoneNumber   Age  Gender Part Class"  );
        
        for(int i = 0;i < data;i++){
        int min = 100000;
        int max = 999999;
        String studNumber = "2022" + (int)Math.floor(Math.random() * (max - min + 1) + min);
        String name = UUID.randomUUID().toString().substring(0,20);
        String icNumber = (int)Math.floor(Math.random() * (max - min + 1) + min) + "" + (int)Math.floor(Math.random() * (max - min + 1) + min);
        min = 0;
        max = 4;
        String cs = course[(int)Math.floor(Math.random() * (max - min + 1) + min)];
        min = 100000;
        max = 999999;
        String phNum = "0" +  (int)Math.floor(Math.random() * (max - min + 1) + min) + "" + (int)Math.floor(Math.random() * (max - min + 1) + min);
        min = 18;
        max = 30;
        int age =  (int)Math.floor(Math.random() * (max - min + 1) + min);
        min = 0;
        max = 1;
        char gender = (int)Math.floor(Math.random() * (max - min + 1) + min) == 1 ? 'M' : 'F';
        min = 1;
        max = 5;
        int part = (int)Math.floor(Math.random() * (max - min + 1) + min);
        String kelas = cs + part;
        System.out.println(studNumber + " " + name + " " + icNumber + " " + cs + "  " + phNum + " " + age + "   " + gender + "      " + part + "    " + kelas );

    }


        
    }
    
}
