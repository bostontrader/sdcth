<?php
namespace App\Controller\Component;
use Cake\Controller\Component;
//use Cake\ORM\TableRegistry;

class GraderComponent extends Component {

    // Get the grades for a given semester and teacher.
    // For all sections with a given semester and teacher...
    //     Get the grades for a particular section.
    //     (Given a section, we know the semester and teacher.)
    //

    // Get the grades for a particular student from a particular section.
    // If $student == null then all students for that section.
    public function getGradeInfo($section, $student) {

        // 1. How many times has this particular section met?
        // select count(*) from clazzes where section_id = section

        // 2. How many times has the student attended that section?
        // select count(*) from interactions where student_id = student and section_id = section and code=role call

        // 3. How many excused absences does the student have?
        // select count(*) from interactions where student_id = student and section_id = section and code=excused absence

        // 4. How many times has the student been ejected from class?
        // select count(*) from interactions where student_id = student and section_id = section and code=ejected

        // A = 2 + 3 - 4 / 1
        // What is the average class participation ?
        // select avg from interactions where student_id = student and section_id = section and code=participation

        // Homework = cp
        // What is the final exam?
        // select from interactions where student_id = student and section_id = section and code=final exam

        //$Sections = TableRegistry::get('Sections');
        //$sections_list = $Sections->find('list');

        return [
            'class_cnt'=>10,
            'attendance'=>4,
            'excused_absence'=>4,
            'ejected'=>2,
            'classroom_participation'=>[1,2,3],
            'final_exam'=>8
        ];
    }

}