<?php
// function to get the current page name
function PageName()
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();
?>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item ">
        <a class="nav-link <?php echo $current_page == 'mainpage.php' ? NULL : 'collapsed' ?>" href="mainpage.php">
          <i class="bi bi-grid"></i>
          <span>Main</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
    <a class="nav-link <?php echo $current_page == 'studyMaterialPage.php' || $current_page == 'addStudyMaterialPage.php' ? NULL : 'collapsed' ?>" data-bs-target="#studyMaterial" data-bs-toggle="collapse" href="#">
      <i class="bi bi-menu-button-wide"></i><span>Study Material</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="studyMaterial" class="nav-content collapse <?php echo $current_page == 'studyMaterialPage.php' || $current_page == 'addStudyMaterialPage.php' ? 'show' : NULL ?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="studyMaterialPage.php" <?php echo $current_page == 'studyMaterialPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-card-list"></i><span>List of Study Material</span>
        </a>
      </li>
      <li>
        <a href="addStudyMaterialPage.php" <?php echo $current_page == 'addStudyMaterialPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-plus-circle"></i><span>Add New Material</span>
        </a>
      </li>
    </ul>
  </li>
      <li class="nav-item">
    <a class="nav-link <?php echo $current_page == 'listExercisePage.php' || $current_page == 'addExercisePage.php' ? NULL : 'collapsed' ?>" data-bs-target="#Exercise" data-bs-toggle="collapse" href="#">
      <i class="bi bi-file-earmark-post"></i><span>Exercise</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="Exercise" class="nav-content collapse <?php echo $current_page == 'listExercisePage.php' || $current_page == 'addExercisePage.php' ? 'show' : NULL ?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="listExercisePage.php" <?php echo $current_page == 'listExercisePage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-card-list"></i><span>List of Exercise</span>
        </a>
      </li>
      <li>
        <a href="addExercisePage.php" <?php echo $current_page == 'addExercisePage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-plus-circle"></i><span>Add New Exercise</span>
        </a>
      </li>
    </ul>
  </li>
    <a class="nav-link  <?php echo strpos($current_page, 'TestPage') ? NULL : 'collapsed' ?>" data-bs-target="#test" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text"></i><span>Test</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="test" class="nav-content collapse <?php echo strpos($current_page, 'TestPage') ? 'show' : NULL ?>" data-bs-parent="#sidebar-nav">
      <li>
        <a href="listTestPage.php" <?php echo $current_page == 'listTestPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-card-list"></i><span>List of Test</span>
        </a>
      </li>
      <li>
        <a href="addTestPage.php" <?php echo $current_page == 'addTestPage.php' ? 'class="active"' : NULL ?>>
          <i class="bi bi-plus-circle"></i><span>Add New Test</span>
        </a>
      </li>
    </ul>
  </li>
      <li class="nav-item">
        <a class="nav-link <?php echo $current_page == 'listStudentsPage.php' ? NULL : 'collapsed' ?>" href="listStudentsPage.php">
          <i class="bi bi-people"></i><span>Students</span>
        </a>
      </li>
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