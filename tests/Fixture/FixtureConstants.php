<?php

namespace App\Test\Fixture;

// We are going to need several fixtures that contain lots of related records.
// By storing the various Ids here, we can more easily ensure that the various records
// are properly related.
class FixtureConstants {

    const clazz1_id = 1;
    const clazz2_id = 2;
    const clazz3_id = 3;
    const clazz4_id = 4;

    const cohort1_id = 1;
    const cohort2_id = 2;

    const interaction1_id = 1;

    const major1_id = 1;
    const major2_id = 2;

    const roleAdminId = 1;
    const roleAdvisorId = 2;
    const roleStudentId = 3;
    const roleTeacherId = 4;

    const section1_id = 1;
    const section2_id = 2;

    const semester1_id = 1;
    const semester2_id = 2;

    const student1_id = 1;
    const student2_id = 2;

    const subject1_id = 1;
    const subject2_id = 2;

    const teacher1_id = 1;
    const teacher2_id = 2;

    const tplan1_id =1;
    const tplan2_id =2;

    const tplan_element1_id =1;
    const tplan_element2_id =2;

    const userAndyAdminId = 1;
    const userArnoldAdvisorId = 2;
    const userSallyStudentId = 3;
    const userTommyTeacherId = 4;

    // When computing scores we need to very carefully weave the above records together such that
    // the following grading results are produced (and thus testable)

    // What are the grading stats for one student and one section?
    const studentToGrade = FixtureConstants::student1_id;
    const sectionToGrade = FixtureConstants::section1_id;

    // How many times did this class meet for this section?
    const clazzCnt = 3;

}