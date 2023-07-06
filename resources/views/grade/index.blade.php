@extends('layouts.index')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/adminDashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    @if(auth()->user() && (auth()->user()->user_type != 'business')&&(auth()->user()->user_type != 'student'))
                        <h1>Grades/Absences</h1>
                    @else
                        <h1>Grades</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section bg-light">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-5 box">
                <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    <div>
                        <label for="courses">Courses:</label>
                        <select name="courses" id="courses">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <div style="position: absolute; top: 0; right: 0;">
                            <div>
                                <span class="date" style="float: right; margin-right: 10px;">Lecture date: <span id="lecture_date"></span></span>
                            </div>

                            <div>
                                <span class="overall-grade" style="float: right; margin-right: 10px;">Overall grade: <span id="overall-grade"></span></span>
                            </div>


                            <div>
                                <span class="module-grade" style="float: right; margin-right: 10px;">Module grade:<span id="module-grade"></span></span>
                            </div>

                            <div>
                                <span class="lecture-grade" style="float: right; margin-right: 10px;">Lecture grade: <span id="lecture-grade"></span></span>
                            </div>
                        </div>

                        <div>
                            <label for="modules">Modules:</label>
                            <select name="modules" id="modules">
                                <option value="">Select Module</option>
                            </select>
                        </div>

                        <div>
                            <label for="lectures">Lectures:</label>
                            <select name="lectures" id="lectures">
                                <option value="">Select Lecture</option>
                            </select>
                        </div>


                        <label for="students">Students:</label>
                        <select name="students" id="students">
                            <option value="">Select Student</option>
                            @if (auth()->user() && auth()->user()->user_type == 'student')
                                <option value="{{ $students->id }}">{{ $students->first_name }} {{ $students->last_name }}</option>
                            {{-- @else
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                                @endforeach --}}
                            @endif
                        </select>

                        @if(auth()->user() && auth()->user()->user_type == 'admin' || auth()->user() && auth()->user()->user_type == 'teacher')
                        <div id="absence-form">
                            @csrf
                            <p style="display: inline-block;">Absence</p><br>
                            <div style="display: inline-block;">
                                <input type="radio" id="radio1" name="radio" style="border-radius: 50%;">
                                <label for="radio1" style="display: inline-block;">Was late</label>

                                <input type="radio" id="radio2" name="radio" style="border-radius: 50%;">
                                <label for="radio2" style="display: inline-block;">Escaped</label>

                                <input type="radio" id="radio3" name="radio" style="border-radius: 50%;">
                                <label for="radio3" style="display: inline-block;">Did not come</label>
                                <div style="display: inline-block; text-align: right; margin-left: 350px;">
                                    <input type="checkbox" id="checkbox4" name="checkbox4" style="border-radius: 50%;" checked>
                                    <label for="checkbox4" style="display: inline-block;">Disregarded</label>
                                </div>
                            </div>
                            <div>
                                <p>Reason/Notes:</p>
                            </div>
                            <div style="position: relative;">
                                <p>Reason/Notes:</p>
                                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                                    <input type="text" style="width: 100%; height: 100%;" name="" id="">
                                </div>
                                <div>
                                    <button type="button" class="save-button">SAVE</button>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <hr>

                        <div id="homeworks-tracker">
                            <table id="homeworks-table">
                                <thead>
                                    <tr>
                                        <th>Task</th>
                                        <th>Status</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        @endif
                        <div>
                        @if(auth()->user() && auth()->user()->user_type == 'admin' || auth()->user() && auth()->user()->user_type == 'teacher')
                            <button type="button" class="save-button-form">SAVE</button>
                        @endif
                            <br>
                            <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $('#courses').on('change', function() {
        let id = $(this).val();
        let url = '/modules/' + id;

        if (id) {
            $.get(url, function(modules) {
                let modulesHtml = '<option value="">Select Module</option>';

                for (const module of modules) {
                    modulesHtml += '<option value="' + module.id + '">' + module.name + '</option>';
                }

                $('#modules').html(modulesHtml);
                $('#lectures').html('<option value="">Select Lecture</option>');
                $('#students').html('<option value="">Select Student</option>');
            });
        }


    });

    $('#modules').on('change', function() {
        let id = $(this).val();
        let url = '/lectures/' + id;

        if (id) {
            $.get(url, function(lectures) {
                let lecturesHtml = '<option value="">Select Lecture</option>';

                for (const lecture of lectures) {
                    lecturesHtml += '<option value="' + lecture.id + '">' + lecture.name + '</option>';
                }

                $('#lectures').html(lecturesHtml);
                $('#students').html('<option value="">Select Student</option>');
            });
        }
    });

    $('#lectures').on('change', function() {
        let id = $(this).val();
        let url = '/getStudents/' + id;

        if (id) {
            $.get(url, function(students) {
                let studentsHtml = '<option value="">Select Student</option>';

                console.log(students);

                for (const student of students) {
                    studentsHtml += '<option value="' + student.id + '">' + student.first_name + '</option>';
                }

                $('#students').html(studentsHtml);
            });
        }
    });

    $('#students').on('change', function() {
        let studentId = $(this).val();
        let lectureId = $('#lectures').val();
        let moduleId = $('#modules').val();
        let url = '/grades/' + studentId + '/' + moduleId;
        console.log(url);

        if (studentId && moduleId) {
            $.get(url, function(response) {
                let overallGradeSum = 0;
                let overallGradeCount = 0;

                let moduleGradeSum = 0;
                let moduleGradeCount = 0;

                let lectureGradeSum = 0;
                let lectureGradeCount = 0;

                for (const grade of response.grades) {
                    overallGradeSum += parseFloat(grade.grade);
                    overallGradeCount++;

                    if (lectureId && grade.lecture_id === parseInt(lectureId)) {
                        lectureGradeSum += parseFloat(grade.grade);
                        lectureGradeCount++;
                    }

                    if (response.lectureIds.includes(grade.lecture_id)) {
                        moduleGradeSum += parseFloat(grade.grade);
                        moduleGradeCount++;
                    }
                }

                if (overallGradeSum && overallGradeCount) {
                    let overallGrade = (overallGradeSum / overallGradeCount).toFixed(2);;

                    $('#overall-grade').text(overallGrade);
                } else {
                    $('#overall-grade').text('-');
                }

                if (lectureGradeSum && lectureGradeCount) {
                    let lectureGrade = (lectureGradeSum / lectureGradeCount).toFixed(2);;

                    $('#lecture-grade').text(lectureGrade);
                } else {
                    $('#lecture-grade').text('-');
                }

                if (moduleGradeSum && moduleGradeCount) {
                    let moduleGrade = (moduleGradeSum / moduleGradeCount).toFixed(2);;

                    $('#module-grade').text(moduleGrade);
                } else {
                    $('#module-grade').text('-');
                }
            });
        }
    });

    $('#lectures').on('change', function() {
        let id = $(this).val();
        let url = '/date/lecture/' + id;
        if (id) {
            $.get(url, function(date) {
                $('.date').text('Lecture date: ' + date);
            });
        }
    });
</script>


<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.save-button').click(function() {
            var lectureId = $('#lectures').val();
            var studentId = $('#students').val();
            var absenceOption = $('input[name="radio"]:checked').next('label').text();
            var disregarded = $('#checkbox4').is(':checked') ? 1 : 0;
            var note = $('input[type="text"]').val();
            if (lectureId && studentId && absenceOption) {
                $.ajax({
                    url: '/save-absence',
                    type: 'POST',
                    data: {
                        lectureId: lectureId,
                        studentId: studentId,
                        absenceOption: absenceOption,
                        disregarded: disregarded,
                        note: note
                    },
                    success: function(response) {
                        console.log(response);
                        alert('Absence saved successful');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                })
            } else {
                alert('You need to choice Lecture, Student and reason');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#students').on('change', function() {
            var studentId = $(this).val();

            $.ajax({
                url: '/students/results/' + studentId,
                method: 'GET',

                success: function(response) {
                    $('#homeworks-table tbody').html('');
                    for (var i = 0; i < response.length; i++) {
                        var grade = response[i];
                        var row = '<tr><td>' + grade.name + '</td><td>';
                        if (grade.type === 'lecture') {
                            row += '<input type="checkbox" id="has" name="has-' + grade.userHomeworkTask + '" style="border-radius: 50%;" disabled="disabled" data-userHomework="' + grade.userHomeworkTask + '"><label for="has-' + grade.userHomeworkTask + '" style="display: inline-block;">Has Homework</label>';
                            row += '<input type="checkbox" id="working" name="working-' + grade.userHomeworkTask + '" style="border-radius: 50%;" data-userHomework="' + grade.userHomeworkTask + '"><label for="working-' + grade.userHomeworkTask + '" style="display: inline-block;">Not Working</label>';
                            row += '<input type="checkbox" id="on_time" name="on_time-' + grade.userHomeworkTask + '" style="border-radius: 50%;" data-userHomework="' + grade.userHomeworkTask + '"><label for="on_time-' + grade.userHomeworkTask + '" style="display: inline-block;">On time</label>';
                        } else {
                            row += '<input type="checkbox" id="has" name="has-' + grade.userHomeworkTask + '" style="border-radius: 50%;" disabled="disabled" checked data-userHomework="' + grade.userHomeworkTask + '"><label for="has-' + grade.userHomeworkTask + '" style="display: inline-block;">Has Homework</label>';
                            row += '<input type="checkbox" ';
                            if (grade.isWorking == 1) {
                                row += 'checked';
                            }
                            row += ' id="working" name="working-' + grade.userHomeworkTask + '" style="border-radius: 50%;" data-userHomework="' + grade.userHomeworkTask + '"><label for="working-' + grade.userHomeworkTask + '" style="display: inline-block;">Not Working</label>';
                            row += '<input type="checkbox" ';
                            if (grade.onTime == 1) {
                                row += 'checked';
                            }
                            row += ' id="on_time" name="on_time-' + grade.userHomeworkTask + '" style="border-radius: 50%;" data-userHomework="' + grade.userHomeworkTask + '"><label for="on_time-' + grade.userHomeworkTask + '" style="display: inline-block;">On time</label>';
                        }
                        row += '</td><td><input type="text" id="grade" name="grade" data-grade-id="' + grade.gradeId + '" value="' + grade.grade + '" size="4"></td></tr>';


                        $('#homeworks-table tbody').append(row);
                        console.log(grade);

                    }
                },
                error: function() {
                    console.log('Error cannot retrieve homeworks.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.save-button-form').click(function() {


            var allGrades = document.querySelectorAll('input[type="text"][id="grade"]');

            var checkboxesHas = document.querySelectorAll('input[type="checkbox"][id="has"]');
            var checkboxesWorking = document.querySelectorAll('input[type="checkbox"][id="working"]');
            var checkboxesOnTime = document.querySelectorAll('input[type="checkbox"][id="on_time"]');

            var allGradesArray = Array.from(allGrades);

            var checkboxesHasArray = Array.from(checkboxesHas);
            var checkboxesWorkingArray = Array.from(checkboxesWorking);
            var checkboxesOnTimeArray = Array.from(checkboxesOnTime);

            var requestAllGrades = [];
            if (allGradesArray.length > 0) {
                console.log('grades');
                allGradesArray.forEach(function(grade) {
                    console.log(grade.getAttribute('data-grade-id') + ' | ' + grade.value);
                    requestAllGrades.push({
                        "grade_id": grade.getAttribute('data-grade-id'),
                        "grade": grade.value
                    });
                });
            }

            var requestAllWorking = [];
            if (checkboxesWorkingArray.length > 0) {
                console.log('working');
                checkboxesWorkingArray.forEach(function(checkbox) {
                    console.log(checkbox.getAttribute('data-userHomework') + ' | ' + checkbox.checked);
                    requestAllWorking.push({
                        "userHomework_id": checkbox.getAttribute('data-userHomework'),
                        "is_working": checkbox.checked
                    });
                });
            }

            var requestAllOnTime = [];
            if (checkboxesOnTimeArray.length > 0) {
                console.log('on_time');
                checkboxesOnTimeArray.forEach(function(checkbox) {
                    console.log(checkbox.getAttribute('data-userHomework') + ' | ' + checkbox.checked);
                    requestAllOnTime.push({
                        "userHomework_id": checkbox.getAttribute('data-userHomework'),
                        "on_time": checkbox.checked
                    });
                });
            }


            $.ajax({
                url: '/save-grades',
                method: 'POST',
                data: {
                    requestAllGrades: requestAllGrades,
                    requestAllWorking: requestAllWorking,
                    requestAllOnTime: requestAllOnTime
                },
                success: function(response) {
                    alert('Grades saved successfully');
                },
                error: function() {
                    alert('Error saving grades');
                }
            });

        });
    });
</script>
@endsection
