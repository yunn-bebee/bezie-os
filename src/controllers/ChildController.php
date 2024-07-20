<?php

require_once 'src/model/ChildModel.php';


class ChildController
{
    public function __construct()
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function childdashboard($id){
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
        $childId = $id;
    
        $child = $childModel -> getChildById($childId);
        $childModel -> assignFirstLessonIfNone($childId);
        $notifications = $this -> getNotification($childId);
        require 'src/views/user/child/dashboard.php';
    }
   public function addChild()
    {
       
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dob = $_POST['child_dob'];
            $age = $this->calculateAge($dob);

            $minAge = 7;
            $maxAge = 12;

            if ($age < $minAge) {
                setcookie('form_error', 'Child is too young. Minimum age is 7.', time() + 3600, '/');
                header('Location: /dashboard');
                exit;
            }

            if ($age > $maxAge) {
                setcookie('form_error', 'Child is too old. Maximum age is 12.', time() + 3600, '/');
                header('Location: /dashboard');
                exit;
            }

            try {
                $levelId = $this->getLevelIdByAge($age);

                $childData = [
                    'name' => $_POST['child_name'],
                    'dob' => $dob,
                    'age' => $age,
                    'gender' => $_POST['child_gender'],
                    'avatar' => isset($_FILES['child_avatar']) && $_FILES['child_avatar']['error'] == UPLOAD_ERR_OK ? $this->uploadAvatar($_FILES['child_avatar']) : '/path/to/placeholder/avatar.jpg',
                    'level' => $levelId
                ];

                $guardianId = $_SESSION['guardian_id'];

                if ($childModel->create($guardianId, $childData)) {
                    setcookie('signup_success', 'Child added successfully', time() + 3600, '/');
                    header('Location: /dashboard');
                    exit;
                } else {
                    setcookie('form_error', 'Unable to add child. Maximum limit reached.', time() + 3600, '/');
                    header('Location: /dashboard');
                    exit;
                }
            } catch (Exception $e) {
                setcookie('form_error', $e->getMessage(), time() + 3600, '/');
                header('Location: /dashboard');
                exit;
            }
        } else {
            setcookie('form_error', 'Form submission error.', time() + 3600, '/');
            header('Location: /dashboard');
            exit;
        }
    }

    
    private function getMinAgeForLevel($levelId)
{
    $conn = getDbConnection();
    $query = "SELECT age_from FROM Levels WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $levelId);
    $stmt->execute();
    $stmt->bind_result($ageFrom);
    $stmt->fetch();
    $stmt->close();
    return $ageFrom;
}
    private function calculateAge($dob)
    {
        $birthDate = new DateTime($dob);
        $today = new DateTime('today');
        $age = $birthDate->diff($today)->y;
        return $age;
    }

    private function getLevelIdByAge($age)
    {
        $conn = getDbConnection();
        $stmt = $conn->prepare("SELECT id FROM Levels WHERE age_from >= ? AND age_to >= ?");
        $stmt->bind_param("ii", $age, $age);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        } else {
            throw new Exception("No level found for age $age");
        }
    }

    public function viewChild()
    {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn); // Instantiate ChildModel

        // Retrieve guardian_id from session
        $guardianId = $_SESSION['guardian_id'];

        return $childModel->getChildren($guardianId);
    }
    public function submitReview() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conn = getDbConnection();
            $childModel = new ChildModel($conn);
    
            $guardianId = $_POST['guardianId'];
            $rating = $_POST['rating'];
            $comment = $_POST['review'];
    
            // Validate inputs (basic validation example)
            if (empty($guardianId) || empty($rating) || empty($comment)) {
                setcookie('review_error', 'Please fill in all fields.', time() + 900, '/'); // 15 minutes expiry
                header('Location: /dashboard');
                exit;
            }
    
            // Ensure rating is within valid range (1 to 5 stars)
            if ($rating < 1 || $rating > 5) {
                setcookie('review_error', 'Invalid rating value.', time() + 900, '/'); // 15 minutes expiry
                header('Location: /dashboard');
                exit;
            }
    
            // Process review submission using ChildModel
            $result = $childModel->addReview($guardianId, $rating, $comment);
    
            if ($result) {
                setcookie('review_success', 'Review submitted successfully.', time() + 900, '/'); // 15 minutes expiry
            } else {
                setcookie('review_error', 'Error submitting review.', time() + 900, '/'); // 15 minutes expiry
            }
    
            header('Location: /dashboard');
            exit;
        }
    
        header('Location: /dashboard');
        exit;
    }
    
    

    private function uploadAvatar($file)
    {
        // Define the target directory
        $targetDir = "src/uploads/avatars/";
    
        // Create the target directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
    
        // Define the target file path
        $targetFile = $targetDir . basename($file["name"]);
    
        // Check if the file is an image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            return null;
        }
    
        // Check file size (limit to 2MB)
        if ($file["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            return null;
        }
    
        // Allow certain file formats
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedTypes)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return null;
        }
    
        // Attempt to move the uploaded file
        if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
            echo "Sorry, there was an error uploading your file.";
            return null;
        }
    
        return $targetFile; // Return the path to the uploaded file
    }
    
    public function countchild(){
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
          // Retrieve guardian_id from session
          $guardianId = $_SESSION['guardian_id'];

          return $childModel->countChildren($guardianId);
    }
    
    public function updateChildProfile()
    {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $childId = $_POST['child_id'];
            $dob = $_POST['child_dob'];
            $age = $this->calculateAge($dob);
    
            $minAge = 7;
            $maxAge = 12;
    
            if ($age < $minAge) {
                setcookie('form_error', 'Child is too young. Minimum age is 7.', time() + 3600, '/');
                header('Location: /dashboard');
                exit;
            }
    
            if ($age > $maxAge) {
                setcookie('form_error', 'Child is too old. Maximum age is 12.', time() + 3600, '/');
                header('Location: /dashboard');
                exit;
            }
    
            try {
                $levelId = $this->getLevelIdByAge($age);
    
                $childData = [
                    'name' => $_POST['child_name'],
                    'dob' => $dob,
                    'age' => $age,
                    'gender' => $_POST['child_gender'],
                    'avatar' => isset($_FILES['child_avatar']) && $_FILES['child_avatar']['error'] == UPLOAD_ERR_OK ? $this->uploadAvatar($_FILES['child_avatar']) : $_POST['current_avatar'],
                    'level' => $levelId
                ];
    
                if ($childModel->update($childId, $childData)) {
                    setcookie('signup_success', 'Child profile updated successfully', time() + 3600, '/'); // 1 hour expiry
                    header('Location: /dashboard');
                    exit;
                } else {
                    setcookie('form_error', 'Unable to update child profile.', time() + 3600, '/');
                    header('Location: /dashboard');
                    exit;
                }
            } catch (Exception $e) {
                setcookie('form_error', $e->getMessage(), time() + 3600, '/');
                header('Location: /dashboard');
                exit;
            }
        } else {
            setcookie('form_error', 'Invalid request method.', time() + 3600, '/');
            header('Location: /dashboard');
            exit;
        }
    }
    
   

    public function  getNotification($childId) {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
        $noti = $childModel->getNotifications($childId);
       return $noti;
     
    }
    public function getMostRecentLessons($childId) {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
        return $childModel->getMostRecentLessons($childId);
    }

   // Function to mark a lesson as completed for a child
   function markLessonAsCompleted($childId, $lessonId) {
    $conn = getDbConnection();
    $childModel = new ChildModel($conn);
    $result = $childModel->completeLesson($childId, $lessonId);

    if ($result) {
        // Set a cookie to indicate success
        setcookie('lesson_status', 'completed', time() + 3600, '/'); // 1 hour expiry
    } else {
        // Set a cookie to indicate failure
        setcookie('lesson_status', 'failed', time() + 3600, '/'); // 1 hour expiry
    }

    // Redirect back to the child's dashboard lesson page
    header("Location: /child/dashboard/{$childId}/lesson/{$lessonId}");
    exit;
}


    public function showLessons($childId) {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
        
        // Fetch child details
        $child = $childModel->getChildById($childId);
        $levelId = $child['level'];
        $mostRecentLessons = $childModel->getMostRecentLessons($childId); 
        // Fetch lessons and subjects
        $lessons = $childModel->getLessonsByLevel($levelId, $childId);
        $subjects = $childModel->getAllSubjects();
        
        $notifications = $this -> getNotification($childId);
        
        // Pass data to view
        require 'src/views/user/child/lessons.php';
    }
    
    
    
    public function trackLessonProgress($childId, $lessonId)
    {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);
        $childModel->trackLessonProgress($childId, $lessonId);
    }

   
 
   

    private function deleteOldAvatar($filePath)
{
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

public function lessondetail($lessonID, $childId) {
    $conn = getDbConnection();
    $childModel = new ChildModel($conn);
    $child = $childModel->getChildById($childId);
    $lessonDetails = $childModel->getLessonDetails($lessonID, $childId);
    $notifications = $this -> getNotification($childId);
    require 'src\views\user\child\lessondetails.php';
}


public function setSecurityAnswer()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);

        $childId = $_POST['child_id'];
        $answer = $_POST['security_answer'];

        if ($childModel->setSecurityAnswer($childId, $answer)) {
            setcookie('signup_error', 'Answer added successfully', time() + 3600, '/'); // 1 hour expiry

            header('Location: /dashboard');
            exit;
        } else {
            echo "Error setting security answer.";
        }
    }
}

public function verifySecurityAnswer()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);

        $childId = $_POST['child_id'];
        $answer = $_POST['security_answer'];

        if ($childModel->verifySecurityAnswer($childId, $answer)) {
            header('Location: /child/dashboard/'.$childId);
            exit;
        } else {
            setcookie('signup_error', 'The answer is wrong :<', time() + 3600, '/');
            header('Location: /dashboard');
        }
    }
}

public function resetSecurityAnswer()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = getDbConnection();
        $childModel = new ChildModel($conn);

        $guardianId = $_SESSION['guardian_id'];
        $childId = $_POST['child_id'];
        $password = $_POST['guardian_password'];

        // Verify guardian's password
        if ($childModel->verifyGuardianPassword($guardianId, $password)) {
            // Allow setting new security answer
            $newAnswer = $_POST['new_security_answer'];
            if ($childModel->setSecurityAnswer($childId, $newAnswer)) {
                header('Location: /dashboard');
                exit;
            } else {
                echo "Error setting new security answer.";
            }
        } else {
            echo "Invalid guardian password.";
        }
    }

} 
}