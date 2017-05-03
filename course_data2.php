<?php
require './inc/php/lib.inc.php';
include("./inc/php/saveToDB.php");


session_start();

if (!array_key_exists('loggedIn', $_COOKIE)) {
    session_destroy();
} else {
    $expire = time() + 60 * 10;//10 minutes from now
    $path = "/";
    $domain = "team-pascal.ist.rit.edu";
    $secure = false;
    $value = date("F j, Y g:i a");
    $value = mt_rand() . mt_rand() . mt_rand();
    setcookie("loggedIn", $value, $expire, $path, $domain, $secure);


}


if (isset($_POST['rptGenerateReport'])) {
    $report = new report();
    $result = $report->export($_POST['rpt_courseName'], $_POST['sections']);

    return $result;
}

$getData = new gettingData();


buildHeader("Data | Course Assessment System");

?>

<header>
    <div>
        <h1 class="logo">Course Assessment System</h1>
    </div>
</header>


<?php
if (array_key_exists('role_id', $_SESSION)) {
    buildNav($_SESSION['role_id']);
} else {
    buildNav(5);
}
?>

<div id="content">
    <div class="tabPg">
        <a href="javascript:void(0)" class="tabs active" onclick="openTab(event, 'custom_stat')">Custom Statistics</a>
        <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'generate_report')">Generate Report</a>
        <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'add_course')">Add Course</a>
        <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'add_section')">Add Section</a>
        <a href="javascript:void(0)" class="tabs" onclick="openTab(event, 'add_program')">Add Program</a>
    </div>


    <!--********************************************-->
    <!--             CUSTOM STATISTIC               -->
    <!--********************************************-->

    <div id="custom_stat" class="tabcontent" style="display:block;">
        <form method="post">

            <p><b><br>Class Information:</b></p>
            <p id="stat_programWrapper">
                <?php
                $getData->getStatPrograms();
                ?>
            </p>

            <p id="stat_courseWrapper">
            </p>

            <p id="stat_termWrapper">
            </p>

            <p id="stat_sectionWrapper">
            </p>

            <div id="stat_btn_ctn">
                <p>Student %
                    <input type="text" class="form-control" name="changeOverThis" id="stat_changeOverThis" value="0"/>

                <p>Grade % Expected
                    <input type="text" class="form-control" name="changeExpected" id="stat_changeExpected" value="0""/>
                </p>

                <button class="btn btn-success" name="stat_showStat" id="stat_showStat">Show Statistic</button>
            </div>

        </form>
    </div>

    <script>

        $(document).ready(function () {
            $('#stat_btn_ctn').hide();
        });
        //TODO: Hide lower level dropdowns if a change is made to upper after initial selections.
        $('#stat_programName').change(function () {
            var programID = $('#stat_programName').val();
            console.log(programID);
            $.ajax({
                type: "POST",
                data: {
                    stat_pid: programID
                },
                url: "./inc/php/dataHandler.php",
                dataType: "html",
                success: function (data) {
                    result = data;
                    console.log(result);
                    console.log("programID: ", programID);
                    $("#stat_courseWrapper").html(result);

                    $('#stat_courseName').change(function () {
                        var courseID = $('#stat_courseName').val();
                        console.log(courseID);
                        $.ajax({
                            type: "POST",
                            data: {
                                stat_cid: courseID
                            },
                            url: "./inc/php/dataHandler.php",
                            dataType: "html",
                            success: function (data) {
                                result = data;
                                console.log(result);
                                console.log("CourseID: ", courseID);
                                $("#stat_termWrapper").html(result);


                                $('#stat_terms').change(function () {
                                    var termID = $('#stat_terms').val();
                                    console.log(termID);
                                    $.ajax({
                                        type: "POST",
                                        data: {
                                            stat_tid: termID,
                                            stat_cid: courseID
                                        },
                                        url: "./inc/php/dataHandler.php",
                                        dataType: "html",
                                        success: function (data) {
                                            result = data;
                                            console.log(result);
                                            console.log("termID: ", termID);
                                            $("#stat_sectionWrapper").html(result);


                                            $('#stat_sectionWrapper').change(function () {

                                                $('#stat_btn_ctn').show();

                                            });
                                        }
                                    });
                                });


                            }
                        });
                    });


                }
            });
        });
    </script>

    <!--********************************************-->
    <!--            GENERATE REPORT                 -->
    <!--********************************************-->


    <div id="generate_report" class="tabcontent">
        <form method="post">

            <p><b><br>Class Information:</b></p>
            <p id="rpt_programWrapper">
                <?php
                $getData->getRptPrograms();
                ?>
            </p>

            <p id="rpt_courseWrapper">

            </p>

            <p id="rpt_termWrapper">

            </p>
            <p id="rpt_sectionWrapper">

            </p>

            <div id="rpt_btn_ctn">
                <button class="btn btn-success" id="rptShowStatistics" name="rptShowStatistics">Show Statistic</button>
                <button class="btn btn-success" id="rptGenerateReport" name="rptGenerateReport">Generate Report /
                    Export
                </button>
            </div>
        </form>
    </div>


    <!--********************************************-->
    <!--               ADD COURSE                   -->
    <!--********************************************-->

    <div id="add_course" class="tabcontent">
        <form method="post">
            <p>
                <?php
                $getData->getCoursePrograms();
                ?></p>

            <p>Course Name:
                <input type="text" name="course" class="form-control"/></p>

            <p>Course Number:
                <input type="text" class="form-control" name="courseNUM"/></p>

            <p>Course Coordinator:
                <?php
                $getData->getUsers("course_coordinator", "course_coordinator");
                ?></p>

            <p>Notes<br>
                <textarea class="form-control" name="notesCourse" rows="4"></textarea></p>

            <button class="btn btn-success" name="addCourseBTN">Submit</button>
        </form>
    </div>

    <!--********************************************-->
    <!--               ADD SECTION                  -->
    <!--********************************************-->

    <div id="add_section" class="tabcontent">
        <form method="post">
            <p>Course Name:
                <?php
                $getData->getCourses("courseSection", "courseSection");
                ?></p>

            <p>Term Number(####):
                <input type="text" name="termSection" class="form-control"/></p>

            <p>Section Number:
                <input type="text" name="numberSection" class="form-control"/></p>

            <p>Program Objectives Supported:
                <textarea class="form-control" name="progObjSection" rows="4"></textarea></p>

            <p>Notes:
                <textarea class="form-control" name="notesSection" rows="4"></textarea></p>

            <p>CAI:
                <input type="text" class="form-control" name="caiSection"/></p>

            <p>Professor:
                <?php
                $getData->getUsers("professorSection", "professorSection");
                ?></p>

            <p>Over This %:
                <input type="text" class="form-control" name="overSection" value="0"/></p>

            <p>Expected %:
                <input type="text" class="form-control" name="expSection" value="0"/></p>

            <p>Assessment Due Date(YYYY-MM-DD):
                <input type="text" class="form-control" name="dueDateSection"/></p>

            <button class="btn btn-success" name="addSectionBTN">Submit</button>
        </form>
    </div>

    <!--********************************************-->
    <!--               ADD PROGRAM                   -->
    <!--********************************************-->

    <div id="add_program" class="tabcontent">
        <form method="post">

            <p>Program Name:
                <input type="text" name="programname" class="form-control"/></p>

            <p>Program Objective:
                <textarea class="form-control" name="progObj" rows="4"></textarea></p>

            <p>Program Coordinator:
                <?php
                $getData->getUsers("program_coordinator", "program_coordinator");
                ?></p>

            <button class="btn btn-success" name="addProgramBTN">Submit</button>
        </form>
    </div>

    <?php
    if (isset($_POST['addCourseBTN'])) {
        $program = $_POST['course_program'];
        $course = $_POST['course'];
        $courseNum = $_POST['courseNUM'];
        $coordinator = $_POST['course_coordinator'];
        $notes = $_POST['notesCourse'];

        $dbconn1 = new addCourse();
        $dbconn1->addCourse($program, $course, $courseNum, $coordinator, $notes);
    }

    if (isset($_POST['addSectionBTN'])) {
        $course = $_POST['courseSection'];
        $term = $_POST['termSection'];
        $sectionNum = $_POST['numberSection'];
        $objectives = $_POST['progObjSection'];
        $notes = $_POST['notesSection'];
        $cai = $_POST['caiSection'];
        $professor = $_POST['professorSection'];
        $overthis = $_POST['overSection'];
        $expected = $_POST['expSection'];
        $duedate = $_POST['dueDateSection'];

        $dbconn1 = new addCourse();
        $dbconn1->addSection($course, $term, $sectionNum, $objectives, $notes, $cai, $professor, $overthis, $expected, $duedate);
    }

    if (isset($_POST['addProgramBTN'])) {
        $program = $_POST['programname'];
        $objective = $_POST['progObj'];
        $coordinator = $_POST['program_coordinator'];

        $dbconn1 = new addCourse();
        $dbconn1->addProgram($program, $objective, $coordinator);
    }

    if (isset($_POST['stat_showStat'])) {
        $classy = $_POST['stat_courseName'];
        $section = $_POST['stat_sections'];
        $percStudent = $_POST['changeOverThis'];
        $newExpected = $_POST['changeExpected'];
        $dbconn1 = new statistics();
        $dbconn1->viewStatistics($classy, $section, $newExpected, $percStudent);

    }

    if (isset($_POST['rptShowStatistics'])) {
        $dbconn1 = new report();
        $res = $dbconn1->showReport($_POST['rpt_courseName'], $_POST['sections']);
        if (count($res) < 1) {
            echo "No results";
        }
        echo "<table class='table'>";
        echo "<tr><th>Program Name<th><th>Program Objective<th><th>Course Name<th><th>Term<th><th>Course Number<th><th>Section Number<th><th>Course Assessment Item<th><th>Expected Percent of Students Achieved<th><th>Actual Percent Students Achieved<th><tr>";
        foreach ($res as $key => $val) {
            echo "<tr><td>" . $val['program_name'] . "<td><td>" . $val['program_objective'] . "<td><td>" . $val['course_name'] . "<td><td>" . $val['term'] . "<td><td>" . $val['course_number'] . "<td><td>" . $val['section_id'] . "<td><td>" . $val['course_assessment_item'] . "<td><td>" . $val['expected_percent_achieved'] . "<td><td>" . $val['percent_students_achieved_obj'] . "<td><tr>";
        }
        echo "</table>";
    }

    ?>

</div>


<?php buildFooter(); ?>
<script>
    $(document).ready(function () {
        $('#rpt_btn_ctn').hide();
    });


    $('#rpt_programName').change(function () {
        var programID = $('#rpt_programName').val();
        console.log(programID);
        $.ajax({
            type: "POST",
            data: {
                rpt_pid: programID
            },
            url: "./inc/php/dataHandler.php",
            dataType: "html",
            success: function (data) {
                result = data;
                console.log(result);
                console.log("programID: ", programID);
                $("#rpt_courseWrapper").html(result);

                $('#rpt_courseName').change(function () {
                    var courseID = $('#rpt_courseName').val();
                    console.log(courseID);
                    $.ajax({
                        type: "POST",
                        data: {
                            rpt_cid: courseID
                        },
                        url: "./inc/php/dataHandler.php",
                        dataType: "html",
                        success: function (data) {
                            result = data;
                            console.log(result);
                            console.log("CourseID: ", courseID);
                            $("#rpt_termWrapper").html(result);


                            $('#rpt_terms').change(function () {
                                var termID = $('#rpt_terms').val();
                                console.log(termID);
                                $.ajax({
                                    type: "POST",
                                    data: {
                                        rpt_tid: termID,
                                        rpt_cid: courseID
                                    },
                                    url: "./inc/php/dataHandler.php",
                                    dataType: "html",
                                    success: function (data) {
                                        result = data;
                                        console.log(result);
                                        console.log("termID: ", termID);
                                        $("#rpt_sectionWrapper").html(result);


                                        $('#rpt_sectionWrapper').change(function () {

                                            $('#rpt_btn_ctn').show();

                                        });
                                    }
                                });
                            });


                        }
                    });
                });


            }
        });
    });


</script>

</body>
</html>
