import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.TableModel;
import javax.swing.table.TableRowSorter;
import java.awt.*;
public class Auxiliary {
    public static void CreateTable(int sortColumn,char sortArrangement,String data[][],String column[],int columnWidth[],String title,int rowHeight){
        JFrame Frame = new JFrame();
        JTable Table;
        JScrollPane ScrollPane;     
        DefaultTableModel TableModel = new DefaultTableModel(data,column);
        if(sortColumn != -1){
            Table = new JTable(TableModel);
            TableRowSorter<TableModel> sorter = new TableRowSorter<TableModel>(Table.getModel());
            Table.setRowSorter(sorter);
            java.util.List<RowSorter.SortKey> sortKeys = new java.util.ArrayList<>(1);
            sortKeys.add(new RowSorter.SortKey(sortColumn, (sortArrangement == 'A' ? SortOrder.ASCENDING : SortOrder.DESCENDING)));
            sorter.setSortKeys(sortKeys);
        }
        else{
            Table = new JTable(TableModel);
        }
        Table.setRowHeight(rowHeight);
        for(int i = 0; i < column.length;i++){
            Table.getColumnModel().getColumn(i).setPreferredWidth(columnWidth[i]);
        }
        Table.setFont(new Font("Times New Roman", Font.BOLD, 15));
        ScrollPane = new JScrollPane(Table);
        Frame.add(ScrollPane);          
        Frame.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        Frame.setVisible(true);
        Frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
    }

    public static void CreateTableClub(int sortColumn,char sortArrangement,String data[][],String column[],int columnWidth[],String title){
        JFrame Frame = new JFrame();
        JTable Table;
        JScrollPane ScrollPane;     
        DefaultTableModel TableModel = new DefaultTableModel(data,column);
        if(sortColumn != -1){
            Table = new JTable(TableModel);
            TableRowSorter<TableModel> sorter = new TableRowSorter<TableModel>(Table.getModel());
            Table.setRowSorter(sorter);
            java.util.List<RowSorter.SortKey> sortKeys = new java.util.ArrayList<>(1);
            sortKeys.add(new RowSorter.SortKey(sortColumn, (sortArrangement == 'A' ? SortOrder.ASCENDING : SortOrder.DESCENDING)));
            sorter.setSortKeys(sortKeys);
        }
        else{
            Table = new JTable(TableModel);
        }
        Table.setRowHeight(10);
        for(int i = 0; i < column.length;i++){
            Table.getColumnModel().getColumn(i).setPreferredWidth(columnWidth[i]);
        }
        Table.getColumn("Club Descriptions").setCellRenderer(new MyCellRenderer());
        Table.setFont(new Font("Times New Roman", Font.BOLD, 15));
        ScrollPane = new JScrollPane(Table);
        Frame.add(ScrollPane);          
        Frame.setExtendedState(JFrame.MAXIMIZED_BOTH); 
        Frame.setVisible(true);
        Frame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
    }

    
}
