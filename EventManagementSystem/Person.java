public class Person {
    protected String Name;
    protected String ContactNumber;
    protected String ICNumber;
    protected char gender;
    protected byte age;
    
    Person(){}
    Person(String n,String cn,String ic,char g,byte a){
        this.Name =n;
        this.ContactNumber =cn;
        this.ICNumber =ic;
        this.gender =g;
        this.age =a;
    }
    public void setName(String temp){this.Name = temp;};
    public void setContactNumber(String temp){this.ContactNumber = temp;};
    public void setICNumber(String temp){this.ICNumber = temp;};
    public void setGender(char temp){this.gender = temp;};
    public void setAge(byte temp){this.age = temp;};
    
    public String getName(){return this.Name; };
    public String getContactNumber(){return this.ContactNumber; };
    public String getICNumber(){return this.ICNumber; };
    public char getGender(){return this.gender; };
    public byte getAge(){return this.age; };
    
    public void UpdateAge(){this.age++;}

    public String toString(){
        return  "Name               : " + this.Name +
                "\nPhone Number     : " + this.ContactNumber +
                "\nIC Number        : " + this.ICNumber +
                "\nGender           : " + (this.gender == 'M' ? "Male" : "Female") +
                "\nAge              : " + this.age;
                
    }
    
}
