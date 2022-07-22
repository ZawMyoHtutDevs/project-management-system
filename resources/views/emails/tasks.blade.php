<div>
    Hello {{ $email_data['userName'] }},
    <br>
    <p>
        New Task Assigned to You
    </p>
    <p>Task Name : {{ $email_data['name'] }}</p>
    <p>Task Deadline : {{ $email_data['end_date'] }}</p><br>

    <san>Regards,</san>
    <p>41 Dev</p>
</div>