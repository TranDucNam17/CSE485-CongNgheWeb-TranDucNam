<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        select,
        button {
            padding: 10px;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background: #f4f4f4;
        }
    </style>
</head>

<body>

    <h1>Student Management System</h1>

    <!-- Dropdown chọn class -->
    <label for="class">Select Class:</label>
    <select id="class">
        <option value="">-- Select Class --</option>
        @foreach($classes as $class)
        <option value="{{ $class->id }}">{{ $class->room_number }}</option>
        @endforeach
    </select>

    <button id="showStudents">Show Students</button>

    <!-- Bảng hiển thị sách -->
    <table id="studentsTable" style="display:none;">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date Of Birth</th>
                <th>Parent Phone</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        document.getElementById('showStudents').addEventListener('click', function() {
            const classId = document.getElementById('class').value;

            if (!classId) {
                alert('Please select a Class.');
                return;
            }

            console.log(`Fetching students for class: ${classId}`);

            fetch(`/students/${classId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Students:', data); // Debug: In ra console

                    const tbody = document.querySelector('#studentsTable tbody');
                    tbody.innerHTML = '';

                    data.forEach((student, index) => {
                        const row = `<tr>
                    <td>${index + 1}</td>
                    <td>${student.first_name}</td>
                    <td>${student.last_name}</td>
                    <td>${student.date_of_birth}</td>
                    <td>${student.parent_phone}</td>
                </tr>`;
                        tbody.innerHTML += row;
                    });

                    document.getElementById('studentsTable').style.display = 'table';
                })
                .catch(err => console.error('AJAX Error:', err));
        });
    </script>

</body>

</html>