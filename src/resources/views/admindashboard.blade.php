<x-app-layout>
    <h1>Admin Dashboard</h1>
    <p>Welcome to the admin dashboard</p>
    <ul>
        <li>
            <a href="">Users</a>
        </li>
        <li>
            <a href="{{ route('trainings.index') }}">Trainingen</a>
        </li>
        <li>
            <a href="{{ route('admin.producten.index') }}">Producten</a>
        </li>
        <li>
            <a href="">Orders</a>
        </li>
    </ul>
</x-app-layout>
