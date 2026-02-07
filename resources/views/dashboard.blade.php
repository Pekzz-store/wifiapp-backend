<h2>Dashboard</h2>

<p>Login sebagai: <b>{{ auth()->user()->username }}</b></p>
<p>Role: <b>{{ auth()->user()->role }}</b></p>

@if(auth()->user()->role === 'admin')
    <ul>
        <li><a href="/admin">Dashboard Admin</a></li>
        <li><a href="/admin/teknisi">Kelola Teknisi</a></li>
        <li><a href="/teknisi">Halaman Teknisi</a></li>
    </ul>
@else
    <ul>
        <li><a href="/teknisi">Halaman Teknisi</a></li>
    </ul>
@endif

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>
