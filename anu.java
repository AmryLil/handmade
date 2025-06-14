package gui;

import model.User;
import dao.UserDAO;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.*;
import java.util.List;

public class UserForm extends JFrame {
    private JTextField nameField;
    private JTextField umurField;
    private JComboBox<String> genderComboBox;
    private JTextField emailField;
    private JButton saveButton;
    private JButton updateButton;
    private JButton deleteButton;
    private JButton clearButton;
    private JTable userTable;
    private DefaultTableModel tableModel;
    private UserDAO userDAO;
    private int selectedUserId = -1;

    // Modern Color Scheme
    private static final Color PRIMARY_COLOR = new Color(41, 128, 185);
    private static final Color SECONDARY_COLOR = new Color(52, 73, 94);
    private static final Color SUCCESS_COLOR = new Color(46, 204, 113);
    private static final Color DANGER_COLOR = new Color(231, 76, 60);
    private static final Color LIGHT_GRAY = new Color(236, 240, 241);
    private static final Color DARK_GRAY = new Color(149, 165, 166);

    public UserForm() {
        super("User Management System");
        userDAO = new UserDAO();
        
        setupLookAndFeel();
        initializeComponents();
        setupLayout();
        setupEventHandlers();
        loadUserData();
        
        // Window settings
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(900, 600);
        setLocationRelativeTo(null);
        setVisible(true);
    }

    private void setupLookAndFeel() {
        try {
            UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void initializeComponents() {
        // Input fields with modern styling
        nameField = createStyledTextField();
        umurField = createStyledTextField();
        emailField = createStyledTextField();
        
        // Gender ComboBox
        String[] genderOptions = {"", "laki-laki", "perempuan"};
        genderComboBox = new JComboBox<>(genderOptions);
        styleComboBox(genderComboBox);

        // Buttons with modern styling
        saveButton = createStyledButton("Simpan", SUCCESS_COLOR);
        updateButton = createStyledButton("Update", PRIMARY_COLOR);
        deleteButton = createStyledButton("Hapus", DANGER_COLOR);
        clearButton = createStyledButton("Clear", DARK_GRAY);
        
        updateButton.setEnabled(false);
        deleteButton.setEnabled(false);

        // Table setup
        String[] columnNames = {"ID", "Nama", "Umur", "Gender", "Email"};
        tableModel = new DefaultTableModel(columnNames, 0) {
            @Override
            public boolean isCellEditable(int row, int column) {
                return false;
            }
        };
        
        userTable = new JTable(tableModel);
        styleTable(userTable);
    }

    private JTextField createStyledTextField() {
        JTextField field = new JTextField(15);
        field.setFont(new Font("Segoe UI", Font.PLAIN, 14));
        field.setBorder(BorderFactory.createCompoundBorder(
            BorderFactory.createLineBorder(DARK_GRAY, 1),
            BorderFactory.createEmptyBorder(8, 12, 8, 12)
        ));
        field.setBackground(Color.WHITE);
        field.setForeground(Color.BLACK);
        field.setCaretColor(Color.BLACK);
        return field;
    }

    private void styleComboBox(JComboBox<String> comboBox) {
        comboBox.setFont(new Font("Segoe UI", Font.PLAIN, 14));
        comboBox.setBackground(Color.WHITE);
        comboBox.setForeground(Color.BLACK);
        comboBox.setBorder(BorderFactory.createLineBorder(DARK_GRAY, 1));
        comboBox.setPreferredSize(new Dimension(180, 35));
    }

    private JButton createStyledButton(String text, Color bgColor) {
        JButton button = new JButton(text);
        button.setFont(new Font("Segoe UI", Font.BOLD, 12));
        button.setBackground(bgColor);
        button.setForeground(Color.WHITE);
        button.setBorder(BorderFactory.createEmptyBorder(10, 20, 10, 20));
        button.setFocusPainted(false);
        button.setCursor(new Cursor(Cursor.HAND_CURSOR));
        
        // Hover effect
        button.addMouseListener(new MouseAdapter() {
            @Override
            public void mouseEntered(MouseEvent e) {
                button.setBackground(bgColor.darker());
            }
            
            @Override
            public void mouseExited(MouseEvent e) {
                button.setBackground(bgColor);
            }
        });
        
        return button;
    }

    private void styleTable(JTable table) {
        table.setFont(new Font("Segoe UI", Font.PLAIN, 12));
        table.setRowHeight(25);
        table.setGridColor(LIGHT_GRAY);
        table.setBackground(Color.WHITE);
        table.setForeground(Color.BLACK);
        table.setSelectionBackground(PRIMARY_COLOR.brighter());
        table.setSelectionForeground(Color.WHITE);
        
        // Header styling
        table.getTableHeader().setFont(new Font("Segoe UI", Font.BOLD, 12));
        table.getTableHeader().setBackground(SECONDARY_COLOR);
        table.getTableHeader().setForeground(Color.WHITE);
        table.getTableHeader().setBorder(BorderFactory.createEmptyBorder());
        
        // Selection mode
        table.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
    }

    private void setupLayout() {
        setLayout(new BorderLayout(10, 10));
        
        // Main panel with padding
        JPanel mainPanel = new JPanel(new BorderLayout(20, 20));
        mainPanel.setBorder(new EmptyBorder(20, 20, 20, 20));
        mainPanel.setBackground(LIGHT_GRAY);
        
        // Form panel (left side)
        JPanel formPanel = createFormPanel();
        
        // Table panel (right side)
        JPanel tablePanel = createTablePanel();
        
        // Split pane for responsive layout
        JSplitPane splitPane = new JSplitPane(JSplitPane.HORIZONTAL_SPLIT, formPanel, tablePanel);
        splitPane.setDividerLocation(350);
        splitPane.setBackground(LIGHT_GRAY);
        
        mainPanel.add(splitPane, BorderLayout.CENTER);
        add(mainPanel);
    }

    private JPanel createFormPanel() {
        JPanel panel = new JPanel();
        panel.setLayout(new BoxLayout(panel, BoxLayout.Y_AXIS));
        panel.setBackground(Color.WHITE);
        panel.setBorder(BorderFactory.createCompoundBorder(
            BorderFactory.createLineBorder(DARK_GRAY, 1),
            new EmptyBorder(20, 20, 20, 20)
        ));

        // Title
        JLabel titleLabel = new JLabel("Form User");
        titleLabel.setFont(new Font("Segoe UI", Font.BOLD, 18));
        titleLabel.setForeground(SECONDARY_COLOR);
        titleLabel.setAlignmentX(Component.CENTER_ALIGNMENT);
        panel.add(titleLabel);
        panel.add(Box.createVerticalStrut(20));

        // Form fields
        panel.add(createFieldPanel("Nama:", nameField));
        panel.add(Box.createVerticalStrut(15));
        
        panel.add(createFieldPanel("Umur:", umurField));
        panel.add(Box.createVerticalStrut(15));
        
        panel.add(createFieldPanel("Gender:", genderComboBox));
        panel.add(Box.createVerticalStrut(15));
        
        panel.add(createFieldPanel("Email:", emailField));
        panel.add(Box.createVerticalStrut(25));

        // Button panel
        JPanel buttonPanel = new JPanel(new FlowLayout(FlowLayout.CENTER, 10, 0));
        buttonPanel.setBackground(Color.WHITE);
        buttonPanel.add(saveButton);
        buttonPanel.add(updateButton);
        buttonPanel.add(deleteButton);
        buttonPanel.add(clearButton);
        
        panel.add(buttonPanel);
        panel.add(Box.createVerticalGlue());

        return panel;
    }

    private JPanel createFieldPanel(String labelText, JComponent field) {
        JPanel panel = new JPanel(new BorderLayout(10, 5));
        panel.setBackground(Color.WHITE);
        
        JLabel label = new JLabel(labelText);
        label.setFont(new Font("Segoe UI", Font.PLAIN, 14));
        label.setForeground(SECONDARY_COLOR);
        
        panel.add(label, BorderLayout.NORTH);
        panel.add(field, BorderLayout.CENTER);
        
        return panel;
    }

    private JPanel createTablePanel() {
        JPanel panel = new JPanel(new BorderLayout());
        panel.setBackground(Color.WHITE);
        panel.setBorder(BorderFactory.createCompoundBorder(
            BorderFactory.createLineBorder(DARK_GRAY, 1),
            new EmptyBorder(20, 20, 20, 20)
        ));

        // Title
        JLabel titleLabel = new JLabel("Daftar User");
        titleLabel.setFont(new Font("Segoe UI", Font.BOLD, 18));
        titleLabel.setForeground(SECONDARY_COLOR);
        panel.add(titleLabel, BorderLayout.NORTH);

        // Table with scroll
        JScrollPane scrollPane = new JScrollPane(userTable);
        scrollPane.setBorder(BorderFactory.createLineBorder(DARK_GRAY, 1));
        scrollPane.getViewport().setBackground(Color.WHITE);
        panel.add(scrollPane, BorderLayout.CENTER);

        return panel;
    }

    private void setupEventHandlers() {
        // Save button
        saveButton.addActionListener(e -> saveUser());
        
        // Update button
        updateButton.addActionListener(e -> updateUser());
        
        // Delete button
        deleteButton.addActionListener(e -> deleteUser());
        
        // Clear button
        clearButton.addActionListener(e -> clearForm());
        
        // Table selection
        userTable.getSelectionModel().addListSelectionListener(e -> {
            if (!e.getValueIsAdjusting()) {
                selectUser();
            }
        });
        
        // Enter key handling
        KeyListener enterKeyListener = new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent e) {
                if (e.getKeyCode() == KeyEvent.VK_ENTER) {
                    if (selectedUserId == -1) {
                        saveUser();
                    } else {
                        updateUser();
                    }
                }
            }
        };
        
        nameField.addKeyListener(enterKeyListener);
        umurField.addKeyListener(enterKeyListener);
        emailField.addKeyListener(enterKeyListener);
    }

    private void saveUser() {
        if (validateInput()) {
            try {
                String nama = nameField.getText().trim();
                int umur = Integer.parseInt(umurField.getText().trim());
                String gender = (String) genderComboBox.getSelectedItem();
                String email = emailField.getText().trim();
                
                User user = new User(nama, umur, gender, email);
                userDAO.createUser(user);
                
                showMessage("User berhasil disimpan!", "Success", JOptionPane.INFORMATION_MESSAGE);
                clearForm();
                loadUserData();
            } catch (NumberFormatException ex) {
                showMessage("Umur harus berupa angka!", "Error", JOptionPane.ERROR_MESSAGE);
            } catch (Exception ex) {
                showMessage("Terjadi kesalahan: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
            }
        }
    }

    private void updateUser() {
        if (validateInput() && selectedUserId != -1) {
            try {
                String nama = nameField.getText().trim();
                int umur = Integer.parseInt(umurField.getText().trim());
                String gender = (String) genderComboBox.getSelectedItem();
                String email = emailField.getText().trim();
                
                User user = new User(nama, umur, gender, email);
                user.setId(selectedUserId);
                userDAO.updateUser(user);
                
                showMessage("User berhasil diupdate!", "Success", JOptionPane.INFORMATION_MESSAGE);
                clearForm();
                loadUserData();
            } catch (NumberFormatException ex) {
                showMessage("Umur harus berupa angka!", "Error", JOptionPane.ERROR_MESSAGE);
            } catch (Exception ex) {
                showMessage("Terjadi kesalahan: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
            }
        }
    }

    private void deleteUser() {
        if (selectedUserId != -1) {
            int confirm = JOptionPane.showConfirmDialog(
                this,
                "Apakah Anda yakin ingin menghapus user ini?",
                "Konfirmasi Hapus",
                JOptionPane.YES_NO_OPTION,
                JOptionPane.QUESTION_MESSAGE
            );
            
            if (confirm == JOptionPane.YES_OPTION) {
                try {
                    userDAO.deleteUser(selectedUserId);
                    showMessage("User berhasil dihapus!", "Success", JOptionPane.INFORMATION_MESSAGE);
                    clearForm();
                    loadUserData();
                } catch (Exception ex) {
                    showMessage("Terjadi kesalahan: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE);
                }
            }
        }
    }

    private void selectUser() {
        int selectedRow = userTable.getSelectedRow();
        if (selectedRow != -1) {
            selectedUserId = (Integer) tableModel.getValueAt(selectedRow, 0);
            nameField.setText((String) tableModel.getValueAt(selectedRow, 1));
            umurField.setText(tableModel.getValueAt(selectedRow, 2).toString());
            genderComboBox.setSelectedItem(tableModel.getValueAt(selectedRow, 3));
            emailField.setText((String) tableModel.getValueAt(selectedRow, 4));
            
            saveButton.setEnabled(false);
            updateButton.setEnabled(true);
            deleteButton.setEnabled(true);
        }
    }

    private void clearForm() {
        nameField.setText("");
        umurField.setText("");
        genderComboBox.setSelectedIndex(0);
        emailField.setText("");
        selectedUserId = -1;
        
        saveButton.setEnabled(true);
        updateButton.setEnabled(false);
        deleteButton.setEnabled(false);
        
        userTable.clearSelection();
    }

    private void loadUserData() {
        tableModel.setRowCount(0);
        List<User> users = userDAO.getAllUsers();
        
        for (User user : users) {
            Object[] row = {
                user.getId(),
                user.getName(),
                user.getUmur(),
                user.getGender(),
                user.getEmail()
            };
            tableModel.addRow(row);
        }
    }

    private boolean validateInput() {
        if (nameField.getText().trim().isEmpty() ||
            umurField.getText().trim().isEmpty() ||
            genderComboBox.getSelectedIndex() == 0 ||
            emailField.getText().trim().isEmpty()) {
            
            showMessage("Semua field harus diisi!", "Validation Error", JOptionPane.WARNING_MESSAGE);
            return false;
        }
        
        try {
            int umur = Integer.parseInt(umurField.getText().trim());
            if (umur <= 0) {
                showMessage("Umur harus lebih dari 0!", "Validation Error", JOptionPane.WARNING_MESSAGE);
                return false;
            }
        } catch (NumberFormatException e) {
            showMessage("Umur harus berupa angka!", "Validation Error", JOptionPane.WARNING_MESSAGE);
            return false;
        }
        
        String email = emailField.getText().trim();
        if (!email.contains("@") || !email.contains(".")) {
            showMessage("Format email tidak valid!", "Validation Error", JOptionPane.WARNING_MESSAGE);
            return false;
        }
        
        return true;
    }

    private void showMessage(String message, String title, int messageType) {
        JOptionPane.showMessageDialog(this, message, title, messageType);
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            try {
                UIManager.setLookAndFeel(UIManager.getSystemLookAndFeelClassName());
            } catch (Exception e) {
                e.printStackTrace();
            }
            new UserForm();
        });
    }
}