<x-master title="{{__('My objectives')}}">

    <x-navbar/>
    <div class="container mt-4">
    <h2>Your Goals</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Progress</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through user's goals and display them in rows -->
            <tr>
                <td>Financial Freedom</td>
                <td>Save $10,000 for emergency fund</td>
                <td>2023-12-31</td>
                <td>60%</td>
                <td>
                    <a href="{{route('Objective.edit')}}">Edit</a> |
                    <a href="{{route('Objective.destroy')}}">Delete</a>
                </td>
            </tr>
            <!-- Repeat for other goals -->
        </tbody>
    </table>
</div>
<x-footer/>
</x-master>