CREATE PROCEDURE find_subordinates
	@employeeid int,
	@employee_firstname varchar(50)
AS

WITH
	employees_cte (EmployeeId, ManagerId, FirstName, LastName)
	AS
	(
					SELECT EmployeeId, ManagerId, FirstName, LastName
			FROM employees
			WHERE EmployeeId = @employeeid AND FirstName = @employee_firstname

		UNION ALL

			SELECT e1.EmployeeId, e1.ManagerId, e1.FirstName, e1.LastName
			FROM employees e1
				INNER JOIN employees_cte e2 ON e1.ManagerId = e2.EmployeeId
	)

SELECT EmployeeId, FirstName, LastName
FROM employees_cte
WHERE EmployeeId <> @employeeid