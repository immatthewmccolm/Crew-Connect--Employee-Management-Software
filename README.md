# Employee Management Software

## Database Structure
1. Employees
    - Employee Code - INT, PK
    - First_Name - VARCHAR(100)
    - Surname - VARCHAR(100)
    - Job_Title - VARCHAR(100)
    - Email_Address - VARCHAR(255)
    - Date_Joined - Date
    - Role - Enum(Standard, Admin)
    - Password - VARCHAR(255)

2. TOIL Requests
    - Request_ID - INT, AUTO INCREMENT, PK
    - Employee_ID - INT, FK
    - Request_Date - DATE
    - Sent_Date - DATE
    - Request_Amount - DECIMAL(5,2)
    - Requested_Hours - DECIMAL(5,2)  -- Amount of hours requested
    - Request_Comments - VARCHAR(255)
    - Request_Status - Enum(Pending, Approved, Declined)
    - Approver_Employee_Code - INT

3. Holiday Requests
    - Request_ID - INT, AUTO INCREMENT, PK
    - Employee_ID - INT, FK
    - Request_Date - DATE
    - Start_Date - DATE
    - End_Date - DATE
    - Request_Comments - VARCHAR(255)
    - Request_Status - Enum(Pending, Approved, Declined)
    - Approver_Employee_Code - INT