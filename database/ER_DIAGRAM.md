# ER Diagram

```text
+------------------+          +--------------------+          +------------------+
|      USERS       |          |    ENROLLMENTS     |          |     COURSES      |
+------------------+          +--------------------+          +------------------+
| PK id            |<-------->| FK user_id         |          | PK id            |
| name             |     1:N  | FK course_id       |--------->| title            |
| email            |          | status             |    N:1   | category         |
| password_hash    |          | enrolled_at        |          | description      |
| role             |          | completed_at       |          | instructor       |
| verified         |          +--------------------+          | duration         |
| otp_hash         |                                           | level            |
| otp_expires_at   |                                           +------------------+
| created_at       |
+------------------+
```

Relationships:
- One user can have many enrollments.
- One course can have many enrollments.
- The enrollments table creates the many-to-many relationship between users and courses.
