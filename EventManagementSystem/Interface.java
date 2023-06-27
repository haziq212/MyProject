import java.awt.*;
import javax.swing.border.*;
import javax.swing.*;
import java.awt.event.*;
import java.io.FileWriter;

/* CURR PANEL
 * contentPane{
 *	 						titlePanel
 
 * 				sideDeco 	interPanel{
 * 							homePage{
 * 							sideButtonPanel
 * 							}
 * 						  }
 * }
 * 
 * 
 */
public class Interface extends JFrame{




	private JPanel contentPane;
	static Dimension size = Toolkit.getDefaultToolkit().getScreenSize();
	static Dimension buttonSize = new Dimension(200,50);

	static Color colorEternity = new Color(16,16,6);
	static Color colorTuatura = new Color(61,61,60);
	static Color colorBazaar= new Color(150,117,117);
	static Color colornwf = new Color(102,66,2);

	static Border empty = BorderFactory.createEmptyBorder();
	static Border comBorder = BorderFactory.createMatteBorder(5, 5, 5, 5, colorTuatura);
	static Border buttonBorder = BorderFactory.createMatteBorder(2, 2, 10, 2, Color.black);
	
	static Font buttonFont = new Font("Times New Roman", Font.BOLD, 16);



	 /**
	 * Create the frame.
	 */

	 public Interface() {
		//MAIN CONTENT PANE
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setExtendedState(JFrame.MAXIMIZED_BOTH);
		setTitle("EVENT MANAGEMENT SYSTEM");
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		contentPane.setLayout(new BorderLayout());
		setContentPane(contentPane);

		//Panel for Logo and Title
		JPanel titlePanel = new JPanel();
		titlePanel.setLayout(new BorderLayout());
		titlePanel.setBorder(comBorder);
		titlePanel.setBackground(Color.BLACK);
		JLabel titleLabel = new JLabel("EVENT MANAGEMENT SYSTEM\r\n");
		titleLabel.setFont(new Font("Source Serif Pro Semibold", Font.BOLD, 39));
		titleLabel.setVerticalAlignment(SwingConstants.CENTER);
		titleLabel.setHorizontalAlignment(SwingConstants.TRAILING);
		titleLabel.setForeground(colorBazaar);
		JLabel logo = new JLabel(new ImageIcon("C:\\Users\\USER\\Documents\\Barang UiTM Arif\\SEMESTER 3\\CSC248\\GROUP ASSIGNMENT\\UiTM Logo.png"));
		titlePanel.add(titleLabel,BorderLayout.WEST);
		titlePanel.add(logo,BorderLayout.EAST);

		contentPane.add(titlePanel,BorderLayout.NORTH);

		//Side Decoration Panel
		JPanel sideDeco = new JPanel();
		sideDeco.setBackground(colorEternity);
		sideDeco.setLayout(new FlowLayout(FlowLayout.LEADING,90,10));
		sideDeco.setBorder(BorderFactory.createMatteBorder(0, 0, 5, 5, colorTuatura));

		contentPane.add(sideDeco,BorderLayout.WEST);

		//Interaction Panel
		JLayeredPane interPanel = new JLayeredPane();
		interPanel.setLayout(new CardLayout(0,0));

		contentPane.add(interPanel,BorderLayout.CENTER);
		
		//Home Page (Page 1) ! Only Contain Side Panel Buttons
		JPanel homePage = new JPanel();
		homePage.setBackground(colorEternity);
		homePage.setBorder(BorderFactory.createMatteBorder(0, 0, 5, 5, colorTuatura));
		homePage.setLayout(new BorderLayout(10,10));
		//Side Panel Buttons for Home Page (Page 1)
		JPanel sideButtonPanel = new JPanel();
		sideButtonPanel.setBackground(colorEternity);
		sideButtonPanel.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 5, colorTuatura));
		sideButtonPanel.setLayout(new FlowLayout(FlowLayout.CENTER,100,30));
		sideButtonPanel.setPreferredSize(new Dimension(250,0));

		homePage.add(sideButtonPanel,BorderLayout.WEST);
		interPanel.add(homePage);

		JButton backToHomePage = new JButton("Back");
		configButton(backToHomePage,colornwf);
		backToHomePage.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				interPanel.removeAll();
				interPanel.add(homePage);
				interPanel.repaint();
				interPanel.revalidate();
			}
		});

		JButton disStud = new JButton("Display Students");
		configButton(disStud,Color.BLACK);
		disStud.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent b) {
				Student.DisplayStudent();
			}
		});

		JButton disStaff = new JButton("Display Staff");
		configButton(disStaff,Color.BLACK);
		disStaff.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent c) {
				Staff.DisplayStaff();
			}
		});

		JButton disClub = new JButton("Display Clubs");
		configButton(disClub,Color.BLACK);
		disClub.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent d) {
				Club.DisplayClubs();
			}
		});


		//JFrame to contain all club buttons;
		JFrame clubContainer = new JFrame();
		JPanel clubContainerPanel = new JPanel();
		clubContainer.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		clubContainer.setSize(900,600);
		clubContainerPanel.setLayout(new WrapLayout(WrapLayout.LEADING,10,30));
		JScrollPane scclubContainerPanel = new JScrollPane(clubContainerPanel);
		clubContainer.add(scclubContainerPanel);
		JButton disEvents = new JButton("Display Events");
		configButton(disEvents,Color.BLACK);
		disEvents.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				clubContainerPanel.removeAll();
				for(int i = 0; i < Server.ClubList.size();i++){
					Club temp = Server.ClubList.get(i);
					JButton clEventButton = new JButton(String.valueOf(temp.getClubID()));
					configButton(clEventButton, Color.BLACK);
					clEventButton.setBackground(Color.white);
					clEventButton.setForeground(Color.BLACK);
					clEventButton.addActionListener(new ActionListener() {
						public void actionPerformed(ActionEvent f) {
							String[][] data = new String[temp.getClubEvents().size()][Events.EventColumn.length];
							for(int i = 0; i < temp.getClubEvents().size();i++){
								Events temp2 = temp.getClubEvents().get(i);
								data[i][0] = String.valueOf(temp2.getClubID());
								data[i][1] = String.valueOf(temp2.getEventID());
								data[i][2] = temp2.getEventName();
								data[i][3] = temp2.getEventDate();
								data[i][4] = temp2.getEventTime();
								data[i][5] = String.valueOf(temp2.getEventDuration());
								data[i][6] = String.valueOf(temp2.getEventBudget());
							}
							Auxiliary.CreateTable(0, 'A', data,Events.EventColumn, Events.EventColumnWidth, temp.getClubName() + "'s Events", 20);
						}
					});
					clubContainerPanel.add(clEventButton);
				}
				interPanel.repaint();
				interPanel.revalidate();
				clubContainer.setVisible(true);
			}
		});

		JButton disMembers = new JButton("Display Club's Members");
		configButton(disMembers,Color.black);
		disMembers.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent g) {
				clubContainerPanel.removeAll();
				for(int i = 0; i < Server.ClubList.size();i++){
					Club kelab = Server.ClubList.get(i);
					JButton clButton = new JButton(String.valueOf(kelab.getClubID()));
					configButton(clButton, Color.BLACK);
					clButton.setBackground(Color.white);
					clButton.setForeground(Color.black);
					clButton.addActionListener(new ActionListener() {
						public void actionPerformed(ActionEvent h) {
							JFrame studofStaff = new JFrame();
							JPanel studofStaffPanel = new JPanel();
							studofStaffPanel.setLayout(new WrapLayout(WrapLayout.LEADING,10,30));
							studofStaff.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
							studofStaff.setContentPane(studofStaffPanel);
							JButton stud = new JButton("Students");
							JButton staf = new JButton("Staffs");
							configButton(stud, Color.black);
							stud.setBackground(Color.white);
							stud.setForeground(Color.black);
							configButton(staf, Color.black);
							staf.setBackground(Color.white);
							staf.setForeground(Color.black);
							stud.addActionListener(new ActionListener() {
								public void actionPerformed(ActionEvent i) {
									String[][] data = new String[kelab.getClubStudents().size()][Student.column.length];
									Student.fill2DArr(data,kelab.getClubStudents());
									Auxiliary.CreateTable(0,'A', data,Student.column, Student.StudentColumnWidth, kelab.getClubName() + "'s Members",30);
									
								}
							});

							staf.addActionListener(new ActionListener() {
								public void actionPerformed(ActionEvent j) {
									String[][] data = new String[kelab.getClubStaff().size()][Staff.column.length];
									Staff.fill2DArr(data,kelab.getClubStaff());
									Auxiliary.CreateTable(0,'A', data,Staff.column, Staff.StaffColumnWidth, kelab.getClubName() + "'s Staff",30);
									
								}
							});

							studofStaffPanel.add(stud);
							studofStaffPanel.add(staf);
							studofStaff.setVisible(true);
							studofStaff.setSize(300,300);


							
						}
					});
					clubContainerPanel.add(clButton);
				}
				interPanel.repaint();
				interPanel.revalidate();
				clubContainer.setVisible(true);

			}
		});


		//Search Panel Functions (Page 2)
		JPanel searchPanel = new JPanel();
		searchPanel.setBorder(BorderFactory.createMatteBorder(0, 0, 5, 5, colorTuatura));
		searchPanel.setLayout(new BorderLayout(10,10));
		searchPanel.setBackground(colorEternity);
		JPanel sideButtonSearchPanel = new JPanel();
		sideButtonSearchPanel.setBackground(colorEternity);
		sideButtonSearchPanel.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 5, colorTuatura));
		sideButtonSearchPanel.setLayout(new FlowLayout(FlowLayout.CENTER,100,40));
		sideButtonSearchPanel.setPreferredSize(new Dimension(250,0));

		JButton searchStud = new JButton("Search Students");
		configButton(searchStud,Color.BLACK);
		searchStud.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent k) {
				Student.Search();
			}
		});
		JButton searchStaff = new JButton("Search Staffs");
		searchStaff.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent l) {
				Staff.Search();
			}
		});
		configButton(searchStaff,Color.BLACK);

		JButton searchClub = new JButton("Search Clubs");
		searchClub.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent m) {
				Club.Search();
			}
		});
		configButton(searchClub,Color.BLACK);

		JButton babi = new JButton("Back");
		configButton(babi,colornwf);
		babi.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				interPanel.removeAll();
				interPanel.add(homePage);
				interPanel.repaint();
				interPanel.revalidate();
			}
		});

		sideButtonSearchPanel.add(searchStud);
		sideButtonSearchPanel.add(searchStaff);
		sideButtonSearchPanel.add(searchClub);
		sideButtonSearchPanel.add(babi);

		searchPanel.add(sideButtonSearchPanel,BorderLayout.WEST);
		JButton searchButton = new JButton("Search");
		configButton(searchButton,Color.black);
		searchButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent n) {
				interPanel.removeAll();
				interPanel.add(searchPanel);
				interPanel.repaint();
				interPanel.revalidate();
				
			}
		});

		
		//Login Page (Page 3)
		JPanel  login = new JPanel();
		login.setLayout(null);
		login.setBackground(colorEternity);
		
		JLabel stfNum =  new JLabel("Staff Number : ");
		stfNum.setFont(new Font("Times New Roman", Font.BOLD,20));
		stfNum.setBounds(33, 80, 190, 24);
		stfNum.setForeground(Color.white);

		JTextField stffield = new JTextField();
		stffield.setBounds(200, 81, 250, 30);
		stffield.setColumns(10);
		stffield.setFont(new Font("Times New Roman", Font.BOLD, 15));
		stffield.setForeground(Color.black);
		

		
		JLabel stfPass = new JLabel("Password 	: ");
		stfPass.setFont(new Font("Times New Roman", Font.BOLD, 20));
		stfPass.setBounds(33, 115, 100, 24);
		stfPass.setForeground(Color.white);

		JPasswordField passfield = new JPasswordField();
		passfield.setColumns(10);
		passfield.setEchoChar('\u2731');
		passfield.setBounds(200, 115, 250, 30);
		passfield.setForeground(Color.black);

		JButton backToHomePage1 = new JButton("Back");
		backToHomePage1.setBounds(33,200,200,50);
		configButton(backToHomePage1,colornwf);
		backToHomePage1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent o) {
				interPanel.removeAll();
				interPanel.add(homePage);
				interPanel.repaint();
				interPanel.revalidate();
			}
		});

		JPanel StaffPanel = new JPanel();
		StaffPanel.setLayout(new BorderLayout());
		StaffPanel.setBackground(Color.black);
		JPanel subStaffPanel = new JPanel();
		subStaffPanel.setLayout(new WrapLayout(WrapLayout.LEADING,10,30));
		subStaffPanel.setBackground(Color.black);

		JButton addStud = new JButton("Add Student");
		JFrame addStudFrame = new JFrame();
		JPanel addStudFramePanel = new JPanel(new SpringLayout());
 //{"Student Number","Name","IC Number","Course","Phone Number","Age","Gender","Part","Class"};

		JTextField[] stdInfoAdd = new JTextField[9];
		for(int i = 0; i < stdInfoAdd.length;i++){
			JLabel l = new JLabel(Student.column[i],JLabel.TRAILING);
			l.setFont(new Font("Times New Roman", Font.BOLD, 15));
			addStudFramePanel.add(l);
			stdInfoAdd[i] = new JTextField();
			stdInfoAdd[i].setBorder(BorderFactory.createLineBorder(Color.black, 2));
			stdInfoAdd[i].setPreferredSize(new Dimension(200,10));
			stdInfoAdd[i].setFont(new Font("Times New Roman", Font.BOLD, 15));
			addStudFramePanel.add(stdInfoAdd[i]);
		}
		JButton canc = new JButton("Cancel");
		JButton tambah = new JButton("Add");
		configButton(canc, Color.black);
		canc.setBackground(Color.white);
		canc.setForeground(Color.BLACK);			

		canc.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent p) {
				addStudFrame.dispose();
			}
		});
		ActionListener addStudAction = new ActionListener() {
			public void actionPerformed(ActionEvent pp) {
				boolean containHaram = false;
				//MORE
				Student temp = new Student();
				for(int i = 0; i < 9;i++){
					String temp123 = stdInfoAdd[i].getText();
					if(temp123.matches("(.*);(.*)"))
					{
						containHaram = true;break;
					}
					if(temp123.isBlank())
					{
						containHaram = true;break;
					}
				}
				//{"Student Number","Name","IC Number","Course","Phone Number","Age","Gender","Part","Class"};
				if(Server.isInteger(stdInfoAdd[0].getText()) && Server.isByte(stdInfoAdd[5].getText()) && !containHaram){
					if(Student.find(Integer.parseInt(stdInfoAdd[0].getText())) != null)JOptionPane.showMessageDialog(null,"Student Number Already Exist");
					else{
						temp.setStudentNumber(Integer.parseInt(stdInfoAdd[0].getText()));
						temp.setName(stdInfoAdd[1].getText());
						temp.setICNumber(stdInfoAdd[2].getText());
						temp.setCourse(stdInfoAdd[3].getText());
						temp.setContactNumber(stdInfoAdd[4].getText());
						temp.setAge(Byte.parseByte(stdInfoAdd[5].getText()));
						temp.setGender(stdInfoAdd[6].getText().charAt(0));
						temp.setPart(stdInfoAdd[7].getText().charAt(0));
						temp.setClass(stdInfoAdd[8].getText().charAt(0));
						//Insertion Sort Pls
						int res = Server.StudentList.size();
						for(int i = Server.StudentList.size() - 1;temp.getStudentNumber() < Server.StudentList.get(i).getStudentNumber();i--){
							res = i;
							if(res == 0)break;
						}
						Server.StudentList.add(res, temp);
						addStudFrame.dispose();
						JOptionPane.showMessageDialog(null,"Successfully added");
						//ADD TO FILES;
						StringBuilder addtoFile = new StringBuilder();
						for(int i = 0; i < Server.StudentList.size();i++){
							Student temp1 = Server.StudentList.get(i);
							addtoFile.append(temp1.toString() + "\n");
						}
						String addtoFile1 = addtoFile.toString();
						try {
							FileWriter tulis = new FileWriter("Student.txt");
							tulis.write(addtoFile1);
							tulis.close();
						} catch (Exception q) {
							q.printStackTrace();
							
						}
					}

				}
				else JOptionPane.showMessageDialog(null,"Invalid Operation");
				

			}
		};
		
		

		

		addStudFramePanel.add(canc);
		addStudFramePanel.add(tambah);
		SpringUtilities.makeCompactGrid(addStudFramePanel,
                                10, 2, //rows, cols
                                6, 6,        //initX, initY
                                20, 20);       //xPad, yPad
		
		addStudFrame.setSize(900,500);
		addStudFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		addStudFrame.setContentPane(addStudFramePanel);
		addStudFrame.setTitle("Add Student");

		addStudFramePanel.setBackground(Color.white);


		configButton(addStud, colorBazaar);
		addStud.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent r) {
				for(ActionListener act : tambah.getActionListeners()){
					tambah.removeActionListener(act);
				}
				configButton(tambah, Color.black);
				tambah.setBackground(Color.white);
				tambah.setForeground(Color.BLACK);	
				tambah.addActionListener(addStudAction);
				tambah.setText("Add");
				for(int i = 0; i < stdInfoAdd.length;i++){
					stdInfoAdd[i].setText("");
				}
				addStudFrame.setVisible(true);
				addStudFrame.setTitle("Add Student");
			}
		});



		JButton alterStud = new JButton("Alter Students");
		configButton(alterStud,colornwf);
		alterStud.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent s) {
				for(ActionListener act : tambah.getActionListeners()){
					tambah.removeActionListener(act);
				}
				configButton(tambah, Color.black);
				tambah.setBackground(Color.white);
				tambah.setForeground(Color.BLACK);
				tambah.setText("Confirm");
				String a = JOptionPane.showInputDialog("Enter Student Number : ");
				if(!Server.isInteger(a))return;
				Student temp = Student.find(Integer.parseInt(a));
				if(temp == null)return;
 //{"Student Number","Name","IC Number","Course","Phone Number","Age","Gender","Part","Class"};
				stdInfoAdd[0].setText(String.valueOf(temp.getStudentNumber()));
				stdInfoAdd[1].setText(temp.getName());
				stdInfoAdd[2].setText(temp.getICNumber());
				stdInfoAdd[3].setText(temp.getCourse());
				stdInfoAdd[4].setText(temp.getContactNumber());
				stdInfoAdd[5].setText(String.valueOf(temp.getAge()));
				stdInfoAdd[6].setText(temp.getGender() + "");
				stdInfoAdd[7].setText(temp.getPart() + "");
				stdInfoAdd[8].setText(temp.getClass2() + "");
				addStudFrame.setVisible(true);
				addStudFrame.setTitle("Alter Student");
				ActionListener altStudAction = new ActionListener() {
					public void actionPerformed(ActionEvent t) {
						if(Integer.parseInt(stdInfoAdd[0].getText()) != temp.getStudentNumber()){
						JOptionPane.showMessageDialog(null,"Cant Change Student Number");
						return;
					}
						boolean containHaram = false;
						for(int i = 0; i < 9;i++){
							String temp123 = stdInfoAdd[i].getText();
							if(temp123.matches("(.*);(.*)")){
								containHaram = true;break;
							}
							if(temp123.isBlank()){
								containHaram = true;break;
							}
						}
						if(Server.isByte(stdInfoAdd[5].getText()) && !containHaram){
							JOptionPane.showMessageDialog(null,"Altered");
							temp.setName(stdInfoAdd[1].getText());
							temp.setICNumber(stdInfoAdd[2].getText());
							temp.setCourse(stdInfoAdd[3].getText());
							temp.setContactNumber(stdInfoAdd[4].getText());
							temp.setAge(Byte.parseByte(stdInfoAdd[5].getText()));
							temp.setGender(stdInfoAdd[6].getText().charAt(0));
							temp.setPart(stdInfoAdd[7].getText().charAt(0));
							temp.setClass(stdInfoAdd[8].getText().charAt(0));
							StringBuilder addtoFile = new StringBuilder();
							for(int i = 0; i < Server.StudentList.size();i++){
								Student temp1 = Server.StudentList.get(i);
								addtoFile.append(temp1.toString() + "\n");
							}
							String addtoFile1 = addtoFile.toString();
							try {
								FileWriter tulis = new FileWriter("Student.txt");
								tulis.write(addtoFile1);
								tulis.close();
							} catch (Exception q) {
								q.printStackTrace();

							}

							addStudFrame.dispose();
						}


					}
				};
				tambah.addActionListener(altStudAction);
			}
		});

		JButton remStud = new JButton("Remove Student");
		configButton(remStud, colorBazaar);
		remStud.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				Student.RemStudent();
			}
		});
		

		JButton addClub = new JButton("Add Club");
		JButton confirmaddClub = new JButton("Add");
		JButton canc1 = new JButton("Cancel");
		configButton(addClub,Color.white);
		configButton(canc1,Color.pink);
		configButton(confirmaddClub,Color.pink);
		confirmaddClub.setForeground(Color.black);
		confirmaddClub.setBackground(Color.white);
		canc1.setForeground(Color.black);
		canc1.setBackground(Color.white);

		JFrame addClubFrame = new JFrame();
		addClubFrame.setSize(900,500);
		JPanel addClubFramePanel = new JPanel(new SpringLayout());
		JTextField[] ClInfoAdd = new JTextField[3];
		for(int i = 0; i < ClInfoAdd.length;i++){
			JLabel tempLabel = new JLabel();
			tempLabel.setText(Club.column[i] + " : ");
			addClubFramePanel.add(tempLabel);
			ClInfoAdd[i] = new JTextField();
			ClInfoAdd[i].setFont((new Font("Times New Roman", Font.BOLD, 15)));
			ClInfoAdd[i].setBorder(BorderFactory.createLineBorder(Color.black, 2));
			addClubFramePanel.add(ClInfoAdd[i]);
		}
		confirmaddClub.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
 			//{"ClubID","Club Name", "Club Descriptions"};
			boolean containHaram = false;
			for(int i = 0; i < ClInfoAdd.length;i++){
				if(ClInfoAdd[i].getText().matches("(.*);(.*)") || ClInfoAdd[i].getText().isEmpty() || ClInfoAdd[i].getText().isBlank()){
					JOptionPane.showMessageDialog(null,"Invalid Operation");
					containHaram = true;
					return;
				}
			}
			if(Club.findClub(Integer.parseInt(ClInfoAdd[0].getText())) != null){
				JOptionPane.showMessageDialog(null,"That Club ID Existed");
				return;
			}

			if(Server.isInteger(ClInfoAdd[0].getText()) && !containHaram){
				Club tempAdd = new Club();
				tempAdd.setClubID(Integer.parseInt(ClInfoAdd[0].getText()));
				tempAdd.setClubName(ClInfoAdd[1].getText());
				tempAdd.setClubDescription(ClInfoAdd[2].getText());
				int insertAt = Server.ClubList.size(); 
				for(int i = Server.ClubList.size() - 1; i >= 0  && tempAdd.getClubID() < Server.ClubList.get(i).getClubID();i--){
					insertAt = i;
					if(i == 0)break;
					// System.out.println("run");
				}
				Server.ClubList.add(insertAt,tempAdd);
				JOptionPane.showMessageDialog(null,"Successfully Added");
				addClubFrame.dispose();
				for(int i = 0; i < ClInfoAdd.length;i++){
					ClInfoAdd[i].setText("");
				}
				String str = "";
				for(int i = 0; i < Server.ClubList.size();i++){
					str += Server.ClubList.get(i).toString() + "\n";
				}
				try {
					FileWriter tulis = new FileWriter("Club.txt");
					tulis.write(str);
					tulis.close();
					
				} catch (Exception e) {
					
				}

			}
			else {
				JOptionPane.showMessageDialog(null,"Invalid Operation");
			}

				
			}
		});
		canc1.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				for(int i = 0; i < ClInfoAdd.length;i++){
					ClInfoAdd[i].setText("");
				}
			addClubFrame.dispose();
			}
		});

		addClub.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				addClubFrame.setVisible(true);		
			}
		});
		addClubFrame.setContentPane(addClubFramePanel);;
		addClubFramePanel.add(canc1);
		addClubFramePanel.add(confirmaddClub);

		
		SpringUtilities.makeCompactGrid(addClubFramePanel,
                                4, 2, //rows, cols
                                6, 6,        //initX, initY
                                20, 20);       //xPad, yPad



		JButton remClub = new JButton("Remove Club");
		configButton(remClub,Color.red);
		remClub.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				String remClub = JOptionPane.showInputDialog(null,"Enter CLub ID : ");
				if(remClub == null)return;
				if(!Server.isInteger(remClub))return;
				Club remKelab = Club.findClub(Integer.parseInt(remClub));
				if(remKelab == null)JOptionPane.showMessageDialog(null,"No Club With That ID");
				else JOptionPane.showMessageDialog(null,remKelab.getClubName() + " is Successfully removed");
				int remIndex = Club.findClub1(Integer.parseInt(remClub));
				Server.ClubList.remove(remIndex);
				String str = "";
				for(int i = 0; i < Server.ClubList.size();i++){
					Club tempKelab123 = Server.ClubList.get(i);
					str = str + tempKelab123.toString() + "\n";
				}

				try{
					FileWriter tulis = new FileWriter("Club.txt");
					tulis.write(str);
					tulis.close();
				}catch(Exception po){

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

		StringBuilder strBuild2 = new StringBuilder();
        for (int i = 0; i < Server.ClubList.size(); i++) {
            Club kelab1 = Server.ClubList.get(i);
            for (int j = 0; j < kelab1.getClubStaff().size(); j++) {
                strBuild2.append(kelab1.getClubID() + ";" + kelab1.getClubStaff().get(j).getStaffNumber() + "\n");
            }
        }
        String isiClub_Staff = strBuild2.toString();
        try {
            FileWriter tulis1 = new FileWriter("Club_Staff.txt");
            tulis1.write(isiClub_Staff);
            tulis1.close();
        } catch (Exception asd) {
        }

		String str1 = "";
		for(int u = 0; u < Server.ClubList.size();u++){
			Club adad = Server.ClubList.get(u);
			str1 = str1 + adad.toStringEvent();
		}
		try {
			FileWriter tules = new FileWriter("Events.txt");
			tules.write(str1);
			tules.close();
		} catch (Exception kok) {
		}
		
		

			}
		});
		

		JButton addStaff = new JButton("Add Staff");
		configButton(addStaff, Color.green);
		JFrame addStaffFrame = new JFrame();
		addStaffFrame.setSize(900,500);
		addStaffFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);

		JPanel addStaffFramePanel  = new JPanel(new SpringLayout());
		addStaffFrame.setContentPane(addStaffFramePanel);
		
		JButton canc2 = new JButton("Cancel");
		configButton(canc2,Color.gray);
		JButton confirmAddStaff = new JButton("Confirm");
		configButton(confirmAddStaff,Color.gray);
		
		
		

		JTextField[] stfInfo = new JTextField[9];
		for(int i = 0; i < stfInfo.length;i++){
			stfInfo[i] = new JTextField();
			stfInfo[i].setBorder(BorderFactory.createLineBorder(Color.black, 2));
			stfInfo[i].setFont((new Font("Times New Roman", Font.BOLD, 15)));
			JLabel l = new JLabel(Staff.column1[i]);
			l.setFont(new Font("Times New Roman", Font.BOLD, 15));
			addStaffFramePanel.add(l);
			addStaffFramePanel.add(stfInfo[i]);
		}



		addStaffFramePanel.add(canc2);
		addStaffFramePanel.add(confirmAddStaff);

		SpringUtilities.makeCompactGrid(addStaffFramePanel,
                                10, 2, //rows, cols
                                6, 6,        //initX, initY
                                20, 20);       //xPad, yPa

		ActionListener confirmAddStaffAction = new ActionListener() {
			public void actionPerformed(ActionEvent pp) {
				if(!Server.isInteger(stfInfo[0].getText()) || Staff.find(Integer.parseInt(stfInfo[0].getText())) != null || stfInfo[0].getText().equals("1")){
					JOptionPane.showMessageDialog(null,"That Staff Number Already Exist");
					return;
				}

				for(int i = 0; i < stfInfo.length;i++){
					String cek = stfInfo[i].getText();
					if(cek.isBlank() || cek.isEmpty() || cek.matches("(.*);(.*)")){
					JOptionPane.showMessageDialog(null,"Invalid Operation");
					return;
				}
				}
				
				JOptionPane.showMessageDialog(null,"Successfully Added");
				addStaffFrame.dispose();
				
//ADAM RAFIE;0192531197;030611010337;M;19;123456;2500;admin;admin
		
				Staff staf = new Staff();
				staf.setStaffNumber(Integer.parseInt(stfInfo[0].getText()));
				staf.setICNumber(stfInfo[1].getText());
				staf.setName(stfInfo[2].getText());
				staf.setContactNumber(stfInfo[3].getText());
				staf.setStaffSalary(Double.parseDouble(stfInfo[4].getText()));
				staf.setGender(stfInfo[5].getText().charAt(0));
				staf.setAge(Byte.parseByte(stfInfo[6].getText()));
				staf.setUser(stfInfo[7].getText());
				staf.setPass(stfInfo[8].getText());
				
				int insertAt = Server.StaffList.size(); 
				for(int i = Server.StaffList.size() - 1; i >= 0  &&  staf.getStaffNumber() < Server.StaffList.get(i).getStaffNumber();i--){
					insertAt = i;
					if(i == 0)break;
					// System.out.println("run");
				}

				Server.StaffList.add(insertAt,staf);
				String str = "";
					for(int i = 0; i < Server.StaffList.size();i++){
						Staff temp32 = Server.StaffList.get(i);
						str = str + temp32.toString() + "\n";

					}
				try {
					FileWriter tulis = new FileWriter("Staff.txt");
					tulis.write(str);
					tulis.close();
					
					
				} catch (Exception e) {
					
				}
				for(int i = 0; i < stfInfo.length;i++){
					stfInfo[i].setText("");
				}



				

			}
		};
		
		addStaff.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				for(ActionListener act : confirmAddStaff.getActionListeners()){
					confirmAddStaff.removeActionListener(act);
				}
				confirmAddStaff.addActionListener(confirmAddStaffAction);
				confirmAddStaff.setText("Add");
				addStaffFrame.setVisible(true);		
			}
		});

		canc2.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent a) {
				for(int i = 0; i < stfInfo.length;i++){
					stfInfo[i].setText("");
				}
				addStaffFrame.dispose();
			}
		});



		JButton alterStaff = new JButton("Alter Staff");
		configButton(alterStaff, Color.cyan);
		alterStaff.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent pp) {
				String stfNum = JOptionPane.showInputDialog(null,"Enter Staff Number : ");
				if(stfNum == null )return;
				if(Staff.find(Integer.parseInt(stfNum)) == null){
					JOptionPane.showMessageDialog(null,"No Staff with that Staff Number");
					return;
				}
				Staff alteredStaff = Staff.find(Integer.parseInt(stfNum));
				stfInfo[0].setText(String.valueOf(alteredStaff.getStaffNumber()));
				stfInfo[1].setText(alteredStaff.getICNumber());
				stfInfo[2].setText(alteredStaff.getName());
				stfInfo[3].setText(alteredStaff.getContactNumber());
				stfInfo[4].setText(String.valueOf(alteredStaff.getStaffSalary()));
				stfInfo[5].setText(alteredStaff.getGender() + "");
				stfInfo[6].setText(String.valueOf(alteredStaff.getAge()));
				stfInfo[7].setText(alteredStaff.getUser());
				stfInfo[8].setText(alteredStaff.getPass());

				for(ActionListener al : confirmAddStaff.getActionListeners()){
					confirmAddStaff.removeActionListener(al);
				}

				ActionListener alterStaffActionConfirm = new ActionListener(){
					public void actionPerformed(ActionEvent pp) {
						for(int i = 0; i < stfInfo.length;i++){
							String cek = stfInfo[i].getText();
							if(cek.isBlank() || cek.isEmpty() || cek.matches("(.*);(.*)")){
							JOptionPane.showMessageDialog(null,"Invalid Operation");
							return;
						}
						}
						if(stfNum.equals(stfInfo[0].getText())){
							alteredStaff.setICNumber(stfInfo[1].getText());
							alteredStaff.setName(stfInfo[2].getText());
							alteredStaff.setContactNumber(stfInfo[3].getText());
							alteredStaff.setStaffSalary(Double.parseDouble(stfInfo[4].getText()));
							alteredStaff.setGender(stfInfo[5].getText().charAt(0));
							alteredStaff.setAge(Byte.parseByte(stfInfo[6].getText()));
							alteredStaff.setUser(stfInfo[7].getText());
							alteredStaff.setPass(stfInfo[8].getText());
							String str = "";
							for(int i = 0; i < Server.StaffList.size();i++){
								Staff temp32 = Server.StaffList.get(i);
								str = str + temp32.toString() + "\n";

							}
							try {
								FileWriter tulis = new FileWriter("Staff.txt");
								tulis.write(str);
								tulis.close();
							} catch (Exception lolo) {
					
							}
							addStaffFrame.dispose();
							JOptionPane.showMessageDialog(null,"Altered Successfully");
						}
						else{
							JOptionPane.showMessageDialog(null,"Cant do that");

						}
					}
				};
				confirmAddStaff.addActionListener(alterStaffActionConfirm);
				addStaffFrame.setVisible(true);
			}
		});
		
		JButton remStaff = new JButton("Remove Staff");
		configButton(remStaff,new Color(255,171,182));
		remStaff.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent a) {
				String stfNum = JOptionPane.showInputDialog(null, "Enter Staff Number : ");
				if(stfNum == null)return;
				int remIndex = Staff.find1(Integer.parseInt(stfNum));
				if(remIndex == -1){
					JOptionPane.showMessageDialog(null,"No Staff with that Staff Number ! ");
					return;
				}

				for(int i = 0; i < Server.ClubList.size();i++){
					Club kelab =  Server.ClubList.get(i);
					int inclub = kelab.findStaff(Integer.parseInt(stfNum));
					if(inclub != -1)kelab.getClubStaff().remove(inclub);
				}

				String str = "";
				for(int i = 0;i < Server.ClubList.size();i++){
					Club kelab =  Server.ClubList.get(i);
					for(int j = 0; j < kelab.getClubStaff().size();j++){
						Staff staf =  kelab.getClubStaff().get(j);
						str = str + kelab.getClubID() + ";" + staf.getStaffNumber() + "\n";
					}
				}
				try {
					FileWriter tulis = new FileWriter("Club_Staff.txt");
					tulis.write(str);
					tulis.close();
				} catch (Exception e) {
					// TODO: handle exception
				}

				Server.StaffList.remove(remIndex);
				
				String str1 = "";
				for(int i = 0; i < Server.StaffList.size();i++){
					Staff staf = Server.StaffList.get(i);
					str1 = str1 + staf.toString() + "\n";
				}

				try {
					FileWriter tulis = new FileWriter("Staff.txt");
					tulis.write(str1);
					tulis.close();
				} catch (Exception e) {
					// TODO: handle exception
				}

			}
		});

		JFrame addEvents = new JFrame();
		addEvents.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
		addEvents.setSize(900,500);
		JPanel addEventsPanel = new JPanel(new SpringLayout());
		JButton canc3 = new JButton("Cancel");
		configButton(canc3, Color.ORANGE );
		JButton confirmAddEvent = new JButton("Add");
		configButton(confirmAddEvent, Color.BLUE);
		addEvents.setContentPane(addEventsPanel);
//{"Club ID","Event ID","Event Name","Event Date","Event Time","Event Duration","Event Budget"};

		JTextField[] addEventFields = new JTextField[6];
		for(int i = 0; i < addEventFields.length;i++){
			addEventFields[i] = new JTextField();
			addEventFields[i].setFont(new Font("Times New Roman", Font.BOLD, 15));
			addEventFields[i].setBorder(BorderFactory.createLineBorder(Color.black, 2));
			JLabel lo = new JLabel(Events.EventColumn[i + 1] + " : ");
			lo.setFont(new Font("Times New Roman", Font.BOLD, 15));
			addEventsPanel.add(lo);
			addEventsPanel.add(addEventFields[i]);
		}

		canc3.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e){
				addEvents.dispose();
				for(int i = 0; i < addEventFields.length;i++){
					addEventFields[i].setText("");
				}
			}
		});

		addEventsPanel.add(canc3);
		addEventsPanel.add(confirmAddEvent);

		SpringUtilities.makeCompactGrid(addEventsPanel,
                                7, 2, //rows, cols
                                6, 6,        //initX, initY
                                20, 20);       //xPad, yPad
		JButton addToClub = new JButton("Add to Club");
		configButton(addToClub,Color.DARK_GRAY);
		addToClub.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent e){

				for(ActionListener al : confirmAddEvent.getActionListeners()){
					confirmAddEvent.removeActionListener(al);
				}
				
				String  show = " 1. Add Student\n2. Add Staff\n3. Add Events\nEnter Number : ";
				String cek = JOptionPane.showInputDialog(null,show);
				if(cek == null || !Server.isInteger(cek) || Integer.parseInt(cek) > 3 ||Integer.parseInt(cek) < 1 )return;
				int cek1 = Integer.parseInt(cek);
				String a = JOptionPane.showInputDialog(null,"Enter Club ID");
				if(a == null)return;
				Club kelab = Club.findClub(Integer.parseInt(a));
				if(kelab == null){
					JOptionPane.showMessageDialog(null,"No Club with that ID ! ");
					return;
				}

				confirmAddEvent.addActionListener(new ActionListener(){
					public void actionPerformed(ActionEvent e){
						Events event = new Events();
						for(int i = 0; i < addEventFields.length;i++){
							String sec = addEventFields[i].getText();
							if(sec.matches("(.*);(.*)") ||  sec.isBlank() || sec.isEmpty()){
								JOptionPane.showMessageDialog(null,"Invalid Operation ! ");
								return;
							}
						}
						

							if(kelab.findEvent(Integer.parseInt(addEventFields[0].getText())) != -1){
								System.out.println(kelab.findEvent(Integer.parseInt(addEventFields[0].getText())));
								JOptionPane.showMessageDialog(null,"That ID Existed! ");
								return;
							}

							event.setByClubID(kelab.getClubID());
							event.setEventID(Integer.parseInt(addEventFields[0].getText()));
							event.setEventName(addEventFields[1].getText());
							event.setEventDate(addEventFields[2].getText());
							event.setEventTime(addEventFields[3].getText());
							event.setEventDuration(Double.parseDouble(addEventFields[4].getText()));
							event.setEventBudget(Double.parseDouble(addEventFields[5].getText()));

							String str = "";
							int insertAt = kelab.getClubEvents().size();
							for(int k = kelab.getClubEvents().size() - 1;k >= 0 && event.getEventID() <  kelab.getClubEvents().get(k).getEventID();k-- ){
								insertAt = k;
								if(k == 0)break;
							}
							kelab.getClubEvents().add(insertAt, event);
							String str1 = "";
							for(int u = 0; u < Server.ClubList.size();u++){
								Club adad = Server.ClubList.get(u);
								str1 = str1 + adad.toStringEvent();
							}
							try {
								FileWriter tules = new FileWriter("Events.txt");
								tules.write(str1);
								tules.close();
							} catch (Exception kok) {
							}
							addEvents.dispose();

						
						
					}
				});
				if(cek1 == 1){
					String stdID = JOptionPane.showInputDialog(null,"Enter Student ID : ");
					if(stdID == null || !Server.isInteger(stdID))return;
					
					Student stud = Student.find(Integer.parseInt(stdID));
					
					if(stud == null){
						JOptionPane.showMessageDialog(null,"No Student with That ID");
						return;
					}

					if(kelab.findMember(stud.getStudentNumber()) != -1){
						JOptionPane.showMessageDialog(null,"That Student is already in this club");
						return;
					}
					int insertAt = kelab.getClubStudents().size();
					for(int i = kelab.getClubStudents().size() - 1;i >= 0 && stud.getStudentNumber() < kelab.getClubStudents().get(i).getStudentNumber();i--){
						insertAt = i;
						if(i == 0)break;
					}
					kelab.getClubStudents().add(insertAt, stud);
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
				else if(cek1 == 2){
					String stfid = JOptionPane.showInputDialog(null, "Enter Staff ID : ");
					if(stfid == null || !Server.isInteger(stfid))return;
					Staff staf = Staff.find(Integer.parseInt(stfid));
					if(staf == null){
						JOptionPane.showMessageDialog(null,"No Staff with that ID");
						return;
					}
					int a1 = kelab.findStaff(staf.getStaffNumber());
					if(a1 != -1){
						JOptionPane.showMessageDialog(null,"That staff is already in this club");
					}
					int insertAt = kelab.getClubStaff().size();
					for(int i = kelab.getClubStaff().size() - 1;i >= 0 && staf.getStaffNumber() < kelab.getClubStaff().get(i).getStaffNumber();i--){
						insertAt = i;
						if(i == 0)break;
					}
					kelab.getClubStaff().add(insertAt, staf);

					StringBuilder strBuild2 = new StringBuilder();
        			for (int i = 0; i < Server.ClubList.size(); i++) {
        			    Club kelab1 = Server.ClubList.get(i);
        			    for (int j = 0; j < kelab1.getClubStaff().size(); j++) {
        			        strBuild2.append(kelab1.getClubID() + ";" + kelab1.getClubStaff().get(j).getStaffNumber() + "\n");
        			    }
        			}
        			String isiClub_Staff = strBuild2.toString();
        			try {
        			    FileWriter tulis1 = new FileWriter("Club_Staff.txt");
        			    tulis1.write(isiClub_Staff);
        			    tulis1.close();
        			} catch (Exception asd) {
        			}





				}
				else{
					//Add Events
					addEvents.setVisible(true);

				}


			}
		});
		JButton remfromClub = new JButton("Remove from Club");
		configButton(remfromClub, new Color(36,37,130));
		remfromClub.addActionListener(new ActionListener(){
			public void actionPerformed(ActionEvent u) {
				String show = "1. Remove Student From Club\n2. Remove Staff From Club\n3. Remove Event From Club";
				String cek = JOptionPane.showInputDialog(null,show);
				if(cek == null || !Server.isInteger(cek))return;
				int ch = Integer.parseInt(cek);
				if(ch < 1 || ch > 3)return;
				String clID = JOptionPane.showInputDialog(null,"Enter Club ID : ");
				Club kelab = Club.findClub(Integer.parseInt(clID));
				if(kelab == null){
					JOptionPane.showMessageDialog(null,"No Club with that ID");
					return;
				}

				if(ch == 1){
					kelab.remStudent();
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
				else if(ch == 2){
					kelab.remStaff();
					StringBuilder strBuild2 = new StringBuilder();
       				for (int i = 0; i < Server.ClubList.size(); i++) {
       				    Club kelab1 = Server.ClubList.get(i);
       				    for (int j = 0; j < kelab1.getClubStaff().size(); j++) {
       				        strBuild2.append(kelab1.getClubID() + ";" + kelab1.getClubStaff().get(j).getStaffNumber() + "\n");
       				    }
       				}
       				String isiClub_Staff = strBuild2.toString();
       				try {
       				    FileWriter tulis1 = new FileWriter("Club_Staff.txt");
       				    tulis1.write(isiClub_Staff);
       				    tulis1.close();
       				} catch (Exception asd) {
       				}
				}
				else {
				kelab.remEvent();
				String str1 = "";
							for(int qq = 0; qq < Server.ClubList.size();qq++){
								Club adad = Server.ClubList.get(qq);
								str1 = str1 + adad.toStringEvent();
							}
							try {
								FileWriter tules = new FileWriter("Events.txt");
								tules.write(str1);
								tules.close();
							} catch (Exception kok) {
							}
				}

			}
		});
		subStaffPanel.add(remfromClub);
		subStaffPanel.add(addToClub);
		subStaffPanel.add(remStaff);
		subStaffPanel.add(alterStaff);
		subStaffPanel.add(addStaff);
		subStaffPanel.add(addClub);
		subStaffPanel.add(remClub);
		subStaffPanel.add(remStud);
		subStaffPanel.add(alterStud);
		subStaffPanel.add(addStud);
		subStaffPanel.add(backToHomePage);

		StaffPanel.add(subStaffPanel,BorderLayout.CENTER);

		JLabel welcome = new JLabel("WELCOME",SwingConstants.CENTER);
		welcome.setVerticalAlignment(SwingConstants.CENTER);
		welcome.setFont(new Font("Times New Roman", Font.BOLD, 40));
		welcome.setForeground(Color.white);
		welcome.setBorder(BorderFactory.createMatteBorder(0,0,5,0,colorTuatura));
		welcome.setPreferredSize(new Dimension(100,130));
		StaffPanel.add(welcome,BorderLayout.NORTH);
		

		JButton loginConfirm = new JButton("Login");
		configButton(loginConfirm, colornwf);
		loginConfirm.setBounds(260,200,200,50);
		loginConfirm.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent u) {
				String check1 = stffield.getText();
				String check2 = new String(passfield.getPassword());
				if(check1.isBlank() ||check1.isEmpty()  || check2.isBlank() || check2.isEmpty())return;
				int stfNam = Integer.parseInt(stffield.getText());
				String stfPass = new String(passfield.getPassword());
				stffield.setText("");
				passfield.setText("");
				Staff admin = new Staff();
				admin.setUser("ADMIN");
				admin.setStaffNumber(1);
				admin.setPass("1");
				if(check1.equals("1") && check2.equals("1")){
				interPanel.removeAll();
				interPanel.add(StaffPanel);
				welcome.setText("WELCOME, " + admin.getUser());
				interPanel.repaint();
				interPanel.revalidate();
				}
				else{
				Staff temp = Staff.find(stfNam);
				if(temp != null && temp.getPass().equals(stfPass)){
				interPanel.removeAll();
				interPanel.add(StaffPanel);
				welcome.setText("WELCOME, " + temp.getUser());
				interPanel.repaint();
				interPanel.revalidate();

				}
				else JOptionPane.showMessageDialog(null,"Wrong Staff Number or Password");
			}
			}
		});
		KeyListener enterListen = new KeyListener(){
			public void keyPressed(KeyEvent t){
				if(t.getKeyCode() == KeyEvent.VK_ENTER){
					loginConfirm.doClick();
				}
			}

			@Override
			public void keyTyped(KeyEvent e) {
			}

			@Override
			public void keyReleased(KeyEvent e) {		
			}
		};

		stffield.addKeyListener(enterListen);
		passfield.addKeyListener(enterListen);
		loginConfirm.addKeyListener(enterListen);
		login.add(stfNum);
		login.add(stfPass);
		login.add(stffield);
		login.add(passfield);
		login.add(loginConfirm);
		login.add(backToHomePage1);

		JButton toLogin = new JButton("Staff Login");
		configButton(toLogin, colorBazaar);
		toLogin.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent v) {
				interPanel.removeAll();
				interPanel.add(login);
				interPanel.repaint();
				interPanel.revalidate();
				
			}
		});

		
		
		
		sideButtonPanel.add(disStud);
		sideButtonPanel.add(disStaff);
		sideButtonPanel.add(disClub);
		sideButtonPanel.add(disEvents);
		sideButtonPanel.add(disMembers);
		sideButtonPanel.add(toLogin);
		sideButtonPanel.add(searchButton);







		
		
	}

	static void configButton(JButton button,Color bgcolor){
		button.setPreferredSize(buttonSize);
		button.setBorder(BorderFactory.createMatteBorder(2, 2, 10, 2, bgcolor));
		button.setBackground(colorEternity);
		button.setForeground(Color.white);
		button.setFont(buttonFont);
	}
}