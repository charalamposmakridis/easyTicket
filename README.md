# EasyTicket 

A modern, role-based Ticket Management System built with **Laravel**. EasyTicket provides a streamlined workflow for clients to submit issues and for support agents and administrators to manage, assign, and resolve tickets efficiently.

---

## Key Features

### Multi-Role Authorization
* **Client**: Creates support tickets, views the status of their own submitted tickets, and updates their ticket details.
* **Agent**: Accesses all submitted tickets, updates ticket statuses, and handles assigned issues.
* **Admin**: Full administrative access to manage all tickets, assign agents, and manage ticket categories.

### Ticket Management Workflow
* **Creation & Categorization**: Clients can create tickets with a title, description, priority level (`low`, `medium`, `high`), and attach multiple categories.
* **Quick Status Updates**: Support staff can instantly update a ticket's status (`open`, `in_progress`, `closed`) directly from the detail view.
* **Agent Assignment**: Admins and Agents can assign or reassign tickets to specific support team members.
* **Validation & Error Handling**: Inline error display and backend Form Request validation to ensure data integrity.

### Data Organization
* **Pagination**: Clean paginated lists for ticket overviews.
* **Pivot Relationship**: Many-to-Many association between tickets and categories.

---

## Tech Stack

* **Framework**: [Laravel 11 / 12]
* **Language**: PHP 8.4+
* **Database**: sqlite
* **Templating**: Blade Views

---

## 🛠️ Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone [https://github.com/your-username/easyTicket.git](https://github.com/charalamposmakridis/easyTicket.git)
   cd easyTicket
