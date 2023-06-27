#include <stdio.h>
#include <stdlib.h>
#include <string.h>

typedef struct {
    char name[50];
    float price;
} MenuItem;

typedef struct {
    MenuItem menu[50];
    int count;
} Menu;

typedef struct {
    MenuItem item;
    int quantity;
} OrderItem;

typedef struct {
    OrderItem items[50];
    int count;
    float total;
} Order;

typedef struct {
    char customerName[50];
    Order order;
} OrderRecord;

typedef struct {
    int totalCustomers;
} CustomerCounter;

CustomerCounter counter = {0};

void addCustomer() {
    counter.totalCustomers++;
}

int getTotalCustomers() {
    return counter.totalCustomers;
}

Menu menu;
OrderRecord customerOrders[50];
int customerCount = 0;

void initializeMenu() {
    menu.count = 0;

    // Add items to the menu
    strcpy(menu.menu[menu.count].name, "Burger");
    menu.menu[menu.count].price = 5.00;
    menu.count++;

    strcpy(menu.menu[menu.count].name, "Fried chicken");
    menu.menu[menu.count].price = 3.00;
    menu.count++;

    // Add more items here...
}

void displayMenu() {
    printf("Menu:\n");
    int i;
    for (i = 0; i < menu.count; i++) {
        printf("%d. %s - RM%.2f\n", i + 1, menu.menu[i].name, menu.menu[i].price);
    }
    printf("\n");
}


void addItemToOrder(int itemIndex, int quantity, const char customerName[]) {
    OrderItem newOrderItem;
    newOrderItem.item = menu.menu[itemIndex - 1];
    newOrderItem.quantity = quantity;

    int orderIndex = -1;
    int i;

    for (i = 0; i < customerCount; i++) {
        if (strcmp(customerOrders[i].customerName, customerName) == 0) {
            orderIndex = i;
            break;
        }
    }

    if (orderIndex == -1) {
        printf("Customer '%s' not found.\n\n", customerName);
        return;
    }

    OrderRecord *customerOrder = &customerOrders[orderIndex];
    Order *order = &customerOrder->order;

    order->items[order->count] = newOrderItem;
    order->count++;

    order->total = 0;  // Initialize total to 0 before calculating

    for (i = 0; i < order->count; i++) {
        order->total += (order->items[i].item.price * order->items[i].quantity);
    }

    printf("Added %d %s to the order of customer '%s'.\n\n", quantity, newOrderItem.item.name, customerName);
}

void displayCustomerOrders() {
    printf("Customer Orders:\n");
    printf("Total Customers: %d\n", getTotalCustomers()); // Display total number of customers

    int i;
    for (i = 0; i < customerCount; i++) {
        OrderRecord customerOrder = customerOrders[i];
        printf("Customer: %s\n", customerOrder.customerName);
        displayOrder(customerOrder.customerName);
    }
}


void removeItemFromOrder(int itemIndex, char customerName[]) {
    int orderIndex = -1;
    int i;

    for (i = 0; i < customerCount; i++) {
        if (strcmp(customerOrders[i].customerName, customerName) == 0) {
            orderIndex = i;
            break;
        }
    }

    if (orderIndex == -1) {
        printf("Customer '%s' not found.\n\n", customerName);
        return;
    }

    OrderRecord *customerOrder = &customerOrders[orderIndex];
    Order *order = &customerOrder->order;

    if (itemIndex < 1 || itemIndex > order->count) {
        printf("Invalid item index. Please try again.\n\n");
        return;
    }

    OrderItem removedItem = order->items[itemIndex - 1];

    for (i = itemIndex - 1; i < order->count - 1; i++) {
        order->items[i] = order->items[i + 1];
    }

    order->count--;
    order->total -= (removedItem.item.price * removedItem.quantity);

    printf("Removed %s from the order of customer '%s'.\n\n", removedItem.item.name, customerName);
}

void displayOrder(char customerName[]) {
    int orderIndex = -1;
    int i;

    for (i = 0; i < customerCount; i++) {
        if (strcmp(customerOrders[i].customerName, customerName) == 0) {
            orderIndex = i;
            break;
        }
    }

    if (orderIndex == -1) {
        printf("Customer '%s' not found.\n\n", customerName);
        return;
    }

    OrderRecord *customerOrder = &customerOrders[orderIndex];
    Order *order = &customerOrder->order;

    printf("Order for customer '%s':\n", customerName);
    for (i = 0; i < order->count; i++) {
        OrderItem currentItem = order->items[i];
        printf("%d. %s (Quantity: %d) - RM%.2f\n", i + 1, currentItem.item.name, currentItem.quantity, currentItem.item.price);
    }
    printf("Total: RM%.2f\n\n", order->total);
}

int main() {
    int choice;
    char customerName[50];
    int itemIndex;
    int quantity;

    initializeMenu();

    while (1) {
        printf("Fast Food Ordering System\n");

        printf("1. Add Customer\n");
        printf("2. Add Item to Order\n");
        printf("3. Remove Item from Order\n");
        printf("4. Display Order\n");
        printf("5. Display Customer Orders\n");
        printf("6. Display Customer Orders\n");
        printf("7. Exit\n");
        printf("Enter your choice: ");
        scanf("%d", &choice);
        printf("\n");

        switch (choice) {
            case 1:
                printf("Enter customer name: ");
                scanf("%s", customerName);
                strcpy(customerOrders[customerCount].customerName, customerName);
                customerCount++;
                addCustomer(); // Increment total customer count
                printf("Customer '%s' added.\n\n", customerName);
                break;
            case 2:
                displayMenu(); 
                printf("Enter the item number: ");
                scanf("%d", &itemIndex);
                printf("Enter the quantity: ");
                scanf("%d", &quantity);
                printf("Enter the customer name: ");
                scanf("%s", customerName);
                addItemToOrder(itemIndex, quantity, customerName);
                break;
            case 3:
                printf("Enter the item number to remove: ");
                scanf("%d", &itemIndex);
                printf("Enter the customer name: ");
                scanf("%s", customerName);
                removeItemFromOrder(itemIndex, customerName);
                break;
            case 4:
                printf("Enter the customer name: ");
                scanf("%s", customerName);
                displayOrder(customerName);
                break;
            case 5:
                displayCustomerOrders();
                break;     
			case 6:
			displayCustomerOrders();
			break;
			           
            case 7:
                printf("Exiting the program.\n");
                exit(0);
            default:
                printf("Invalid choice. Please try again.\n\n");
                break;
        }
    }

    return 0;
}

