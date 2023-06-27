import java.awt.*;
import javax.swing.border.*;
import javax.swing.table.DefaultTableCellRenderer;
import javax.swing.table.TableCellRenderer;
import javax.swing.*;
import java.awt.event.*;


public class MyCellRenderer extends JTextArea implements TableCellRenderer {

    @Override
public Component getTableCellRendererComponent(JTable table, Object value, boolean isSelected, boolean hasFocus,
        int row, int column) {
    this.setText((String) value);
    this.setWrapStyleWord(true);
    this.setLineWrap(true);
    Font font = new Font("Times New Roman", Font.BOLD, 15);
    this.setFont(font);
    int fontHeight = this.getFontMetrics(this.getFont()).getHeight();
    int textLength = this.getText().length();
    int lines = textLength / this.getColumnWidth();
    if (lines == 0) {
        lines = 1;
    }

    int height = fontHeight * lines;
    table.setRowHeight(row, height);
    

    return this;
 }

}    

