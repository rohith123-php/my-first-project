# School Management System (SMS) Implementation Plan
This document outlines the architecture, database schema, and implementation plan for the PHP-based School Management System.
## User Review Required
> [!IMPORTANT]
> Since this project requires a database, I will provide the SQL schema to create the tables. You will need a working XAMPP setup (or similar MySQL/PHP environment) to run this. Please confirm if you have XAMPP installed and running, or if you need assistance setting it up.
>
> I will be creating the project files in a new directory: `C:\Users\ctc\.gemini\antigravity\scratch\school_management_system`. Please let me know if you would prefer a different location, such as directly inside your XAMPP `htdocs` directory (e.g., `C:\xampp\htdocs\sms`).
## Open Questions
> [!NOTE]
> 1. Do you want me to write plain PHP (procedural or OOP without a framework) as is typical for this kind of BCA project, or would you prefer a specific lightweight structure?
> 2. Should I include a basic setup script (`setup.php`) that automatically creates the database and tables?
> 3. For styling, you requested Bootstrap. Are you okay with using Bootstrap 5 via CDN for simplicity?
## Proposed Architecture & File Structure
The project will use a standard PHP structure with separated concerns where possible, using Bootstrap for the UI.
```text
/school_management_system
├── /assets
│   ├── /css
│   │   └── style.css
│   └── /js
│       └── main.js
├── /includes
│   ├── db.php          (Database connection)
│   ├── header.php      (Common HTML header & nav)
│   └── footer.php      (Common HTML footer)
├── /admin              (Admin Module)
│   ├── index.php       (Dashboard)
│   ├── students.php    (CRUD Students)
│   ├── teachers.php    (CRUD Teachers)
│   ├── classes.php     (Manage Classes)
│   └── reports.php     (Generate Reports)
├── /teacher            (Teacher Module)
│   ├── index.php       (Dashboard)
│   ├── attendance.php  (Manage Attendance)
│   └── marks.php       (Enter Marks)
├── /student            (Student Module)
│   ├── index.php       (Dashboard)
│   ├── profile.php     (View Profile)
│   ├── attendance.php  (View Attendance)
│   └── results.php     (View Marks)
├── index.php           (Landing Page & Login Selection)
├── login.php           (Authentication Logic)
└── logout.php          (Session Destroy)
```
## Database Schema (MySQL)
We will need the following core tables:
1.  **users**: Stores authentication details for Admin, Teacher, and Student.
    *   `id`, `username`, `password`, `role` (admin, teacher, student), `reference_id` (links to student/teacher profile)
2.  **students**: Student profile details.
    *   `id`, `first_name`, `last_name`, `dob`, `class_id`, `contact`
3.  **teachers**: Teacher profile details.
    *   `id`, `first_name`, `last_name`, `contact`, `subject_specialization`
4.  **classes**: Class/Grade information.
    *   `id`, `class_name`
5.  **subjects**: Subjects offered.
    *   `id`, `subject_name`, `class_id`, `teacher_id`
6.  **attendance**: Daily attendance records.
    *   `id`, `student_id`, `date`, `status` (Present/Absent)
7.  **marks**: Student grades.
    *   `id`, `student_id`, `subject_id`, `marks_obtained`, `total_marks`
## Implementation Phases
### Phase 1: Setup & Database
*   Create the directory structure.
*   Write `db.php` for MySQL connection.
*   Create a `database.sql` file or `setup.php` to initialize the database schema.
### Phase 2: Authentication
*   Implement `login.php` to handle login for all 3 roles using sessions.
*   Create `logout.php`.
*   Setup role-based access control (RBAC) to protect specific directories (e.g., redirect non-admins from the `/admin` folder).
### Phase 3: Admin Module
*   Implement Admin dashboard layout.
*   Build Student CRUD operations (Add, Edit, Delete, View).
*   Build Teacher CRUD operations.
*   Implement Class and Subject management.
### Phase 4: Teacher Module
*   Implement Teacher dashboard.
*   Create views to list students in their classes.
*   Build the attendance marking interface.
*   Build the marks entry interface.
### Phase 5: Student Module
*   Implement Student dashboard.
*   Create view for personal profile.
*   Create views for their own attendance and marks.
### Phase 6: Polish
*   Ensure Bootstrap styling looks clean and responsive across all pages.
*   Add basic form validation (client-side and server-side).
## Verification Plan
### Manual Verification
1.  Verify the database tables are created successfully.
2.  Test logging in as the default Admin.
3.  Create a Teacher and a Student via the Admin panel.
4.  Logout and test logging in as the newly created Teacher and Student.
5.  Test the full flow: Teacher marks attendance and grades -> Student views them.

