<?php

class Paper
{
    private $conn;
    private $table = 'papers';

    public $id;
    public $title;
    public $category;
    public $subject;
    public $year;
    public $file_path;
    public $uploaded_by;
    public $upload_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all papers
    public function getAllPapers()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get single paper
    public function getPaper()
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }

    // Add paper
    public function addPaper()
    {
        $query = 'INSERT INTO ' . $this->table . ' 
                  SET title = :title, category = :category, subject = :subject, 
                      year = :year, file_path = :file_path, uploaded_by = :uploaded_by';
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->file_path = htmlspecialchars(strip_tags($this->file_path));
        $this->uploaded_by = htmlspecialchars(strip_tags($this->uploaded_by));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':subject', $this->subject);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':file_path', $this->file_path);
        $stmt->bindParam(':uploaded_by', $this->uploaded_by);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Update paper
    public function updatePaper()
    {
        $query = 'UPDATE ' . $this->table . ' 
                  SET title = :title, category = :category, subject = :subject, 
                      year = :year, file_path = :file_path, uploaded_by = :uploaded_by
                  WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->file_path = htmlspecialchars(strip_tags($this->file_path));
        $this->uploaded_by = htmlspecialchars(strip_tags($this->uploaded_by));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':subject', $this->subject);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':file_path', $this->file_path);
        $stmt->bindParam(':uploaded_by', $this->uploaded_by);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Delete paper
    public function deletePaper()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Get all departments by category
    public function getDepartmentsByCategory($category)
    {
        $query = 'SELECT DISTINCT department FROM ' . $this->table . ' WHERE category = :category';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Get all courses by department
    public function getCoursesByDepartment($category, $department)
    {
        $query = 'SELECT DISTINCT course FROM ' . $this->table . ' WHERE category = :category AND department = :department';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':department', $department);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Get papers by category, department, and course
    public function getPapersByCategoryDepartmentCourse($category, $department, $course)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE category = :category AND department = :department AND course = :course';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':course', $course);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Get papers uploaded by a specific user
    public function getPapersByUser($userId)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE uploaded_by = :userId';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get papers by subject
    public function getPapersBySubject($subject)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE subject = :subject';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject', $subject);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get papers by year
    public function getPapersByYear($year)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE year = :year';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get papers by category and year
    public function getPapersByCategoryAndYear($category, $year)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE category = :category AND year = :year';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':year', $year);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Search papers by title
    public function searchPapers($keyword)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE title LIKE :keyword';
        $stmt = $this->conn->prepare($query);
        $keyword = '%' . $keyword . '%'; // Add wildcards for partial matching
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Add paper with tags
    public function addPaperWithTags($title, $category, $subject, $year, $file_path, $uploaded_by, $tags)
    {
        $query = 'INSERT INTO ' . $this->table . ' 
              SET title = :title, category = :category, subject = :subject, 
                  year = :year, file_path = :file_path, uploaded_by = :uploaded_by, tags = :tags';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':file_path', $file_path);
        $stmt->bindParam(':uploaded_by', $uploaded_by);
        $stmt->bindParam(':tags', $tags);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    // Update paper details including tags
    public function updatePaperDetails($paperId, $title, $category, $year, $tags)
    {
        $query = 'UPDATE ' . $this->table . ' 
              SET title = :title, category = :category, year = :year, tags = :tags
              WHERE id = :paperId';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':paperId', $paperId);

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    // Get papers by tag
    public function getPapersByTag($tag)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE tags LIKE :tag';
        $stmt = $this->conn->prepare($query);
        $tag = '%' . $tag . '%'; // Add wildcards for partial matching
        $stmt->bindParam(':tag', $tag);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Search papers by tag
    public function searchPapersByTag($tag)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE tags LIKE :tag';
        $stmt = $this->conn->prepare($query);
        $tag = '%' . $tag . '%'; // Add wildcards for partial matching
        $stmt->bindParam(':tag', $tag);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get popular papers by views
    public function getPopularPapersByViews($limit = 10)
    {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY view_count DESC LIMIT :limit';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Increment view count for a paper
    public function incrementViewCount($paperId)
    {
        $query = 'UPDATE ' . $this->table . ' SET view_count = view_count + 1 WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $paperId);
        $stmt->execute();
    }

    // Get view count for a paper
    public function getViewCount($paperId)
    {
        $query = 'SELECT view_count FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $paperId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['view_count'];
    }
    public function getRelatedPapersByTags($paperId, $limit = 5)
    {
        // Retrieve tags associated with the paper
        $query = 'SELECT tag_id FROM paper_tags WHERE paper_id = :paper_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // If paper has no tags, return empty array
        if (empty ($tags)) {
            return [];
        }

        // Find papers with similar tags
        $query = 'SELECT p.* 
                  FROM papers p
                  INNER JOIN paper_tags pt ON p.id = pt.paper_id
                  WHERE pt.tag_id IN (' . implode(',', $tags) . ')
                  AND p.id != :paper_id
                  GROUP BY p.id
                  ORDER BY COUNT(*) DESC
                  LIMIT :limit';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRelatedPapersByCourse($paperId, $limit = 5)
    {
        // Retrieve course of the specified paper
        $query = 'SELECT course FROM papers WHERE id = :paper_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_COLUMN);

        // Find papers with the same course
        $query = 'SELECT * FROM papers WHERE course = :course AND id != :paper_id LIMIT :limit';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':course', $course);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRelatedPapersByDepartment($paperId, $limit = 5)
    {
        // Retrieve department of the specified paper
        $query = 'SELECT department FROM papers WHERE id = :paper_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->execute();
        $department = $stmt->fetch(PDO::FETCH_COLUMN);

        // Find papers with the same department
        $query = 'SELECT * FROM papers WHERE department = :department AND id != :paper_id LIMIT :limit';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRelatedPapersByYear($paperId, $limit = 5)
    {
        // Retrieve year of the specified paper
        $query = 'SELECT year FROM papers WHERE id = :paper_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->execute();
        $year = $stmt->fetch(PDO::FETCH_COLUMN);

        // Find papers from the same year
        $query = 'SELECT * FROM papers WHERE year = :year AND id != :paper_id LIMIT :limit';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':paper_id', $paperId);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Get related papers based on multiple criteria
    public function getRelatedPapers($paperId, $limit = 5)
    {
        // Get related papers by tags
        $relatedByTags = $this->getRelatedPapersByTags($paperId, $limit);

        // Get related papers by course
        $relatedByCourse = $this->getRelatedPapersByCourse($paperId, $limit);

        // Get related papers by department
        $relatedByDepartment = $this->getRelatedPapersByDepartment($paperId, $limit);

        // Get related papers by year
        $relatedByYear = $this->getRelatedPapersByYear($paperId, $limit);

        // Combine related papers from all criteria into a single array
        $relatedPapers = array_merge($relatedByTags, $relatedByCourse, $relatedByDepartment, $relatedByYear);

        // Count occurrences of each paper ID
        $counts = array_count_values(array_column($relatedPapers, 'id'));

        // Sort papers by number of occurrences (most matched first)
        arsort($counts);

        // Return top $limit papers
        return array_slice($counts, 0, $limit);
    }
    public function filterPapersByCategory($category) {
        $query = 'SELECT * FROM papers WHERE category = :category';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sortPapersByUploadDate($order = 'DESC') {
        $query = 'SELECT * FROM papers ORDER BY upload_date ' . $order;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPaperCountByCategory() {
        $query = 'SELECT category, COUNT(*) AS count FROM papers GROUP BY category';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
            

}


?>


<!-- // Include the database class file
require_once 'Database.php';

// Create a new instance of the Database class
$database = new Database();

// Get the database connection
$conn = $database->getConnection(); -->

<!-- // Include the Paper class file
require_once 'Paper.php';

// Create a new instance of the Paper class
$paper = new Paper($conn);

// Example usage: Get all papers
$result = $paper->getAllPapers();

// Example usage: Add a new paper
$paper->title = 'Sample Paper';
$paper->category = 'endsem';
$paper->subject = 'Sample Subject';
$paper->year = 2024;
$paper->file_path = '/path/to/file';
$paper->uploaded_by = 1; // User ID who uploaded the paper
if ($paper->addPaper()) {
    echo 'Paper added successfully.';
} else {
    echo 'Failed to add paper.';
} -->