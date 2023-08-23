<?php

/**
 * A class for interacting with a database using PDO.
 */
class DbContext
{
    /**
     * @var PDO|null The PDO instance for database connections.
     */
    private $pdo;

    /**
     * Initializes a new DbContext instance and establishes a database connection.
     */
    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * Executes a query and returns the result as an associative array.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An associative array of parameters for the query.
     * @return array The result of the query as an associative array.
     * @throws PDOException If the query execution fails.
     */
    public function query($sql, $params = []): array
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    /**
     * Executes a query and returns the number of affected rows.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An associative array of parameters for the query.
     * @return int The number of affected rows.
     * @throws PDOException If the query execution fails.
     */
    public function execute($sql, $params = []): int
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->rowCount();
        } catch (PDOException $e) {
            die("Execution failed: " . $e->getMessage());
        }
    }

    /**
     * Executes a query and returns a single scalar value.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An associative array of parameters for the query.
     * @return int The single scalar value returned by the query.
     * @throws PDOException If the query execution fails.
     */
    public function getScalar($sql, $params = []): int
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            $result = $statement->fetchColumn();
            if ($result === false || $result === null) {
                return 0;
            }

            return $result;
        } catch (PDOException $e) {
            die("Execution failed: " . $e->getMessage());
        }
    }

    /**
     * Starts a database transaction.
     *
     * @return void
     */
    public function beginTransaction(): void
    {
        $this->pdo->beginTransaction();
    }

    /**
     * Commits the current database transaction.
     *
     * @return void
     */
    public function commit(): void
    {
        $this->pdo->commit();
    }

    /**
     * Rolls back the current database transaction.
     *
     * @return void
     */
    public function rollback(): void
    {
        $this->pdo->rollback();
    }

    /**
     * Disconnects from the database by setting the PDO instance to null.
     *
     * @return void
     */
    public function disconnect(): void
    {
        $this->pdo = null;
    }
}
