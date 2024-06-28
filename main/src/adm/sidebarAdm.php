<?php
// function to get the current page name
function PageName()
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?php echo $current_page == 'dashboard.php' ? NULL : 'collapsed' ?>" href="dashboard.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link <?php echo strpos($current_page, 'TeacherPage')  ? NULL : 'collapsed' ?>" data-bs-target="#teacher" data-bs-toggle="collapse" href="#">
      <i class="bi bi-people-fill"></i><span>Teachers</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="teacher" class="nav-content collapse <?php echo strpos($current_page, 'TeacherPage')  ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="listTeacherPage.php" <?php echo $current_page == 'listTeacherPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-card-list"></i><span>List of Teachers</span>
        </a>
      </li>
      <li>
        <a href="addTeacherPage.php" <?php echo $current_page == 'addTeacherPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-plus-circle"></i><span>Add New Teacher</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo strpos($current_page, 'StudentPage')  ? NULL : 'collapsed' ?>" data-bs-target="#student" data-bs-toggle="collapse" href="#">
      <i class="bi bi-people"></i><span>Students</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="student" class="nav-content collapse <?php echo strpos($current_page, 'StudentPage')  ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="listStudentPage.php" <?php echo $current_page == 'listStudentPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-card-list"></i><span>List of Students</span>
        </a>
      </li>
      <li>
        <a href="addStudentPage.php" <?php echo $current_page == 'addStudentPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-plus-circle"></i><span>Add New Student</span>
        </a>
      </li>
    </ul>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link <?php echo $current_page == 'listStudyMaterialPage.php' ? NULL : 'collapsed' ?>"  href="listStudyMaterialPage.php">
      <i class="bi bi-journal-text"></i><span>List of Study Material</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo $current_page == 'listTestPage.php' ? NULL : 'collapsed' ?>"  href="listTestPage.php">
      <i class="bi bi-journal-text"></i><span>List of Tests</span>
    </a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link <?php echo $current_page == 'listFeedbackPage.php' ? NULL : 'collapsed' ?>" href="listFeedbackPage.php">
      <i class="bi bi-layout-text-window-reverse"></i><span>Feedback</span>
    </a>
  </li>
  <li class="nav-item">
        <a class="nav-link <?php echo $current_page == 'myProfilePage.php' ? NULL : 'collapsed' ?>" href="myProfilePage.php">
          <i class="bi bi-person"></i><span>My Profile</span>
        </a>
      </li>
  

</ul>

</aside><!-- End Sidebar-->