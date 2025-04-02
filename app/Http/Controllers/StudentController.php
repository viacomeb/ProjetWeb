public function dashboard()
{
$user = auth()->user();

// Vérifiez si l'utilisateur est connecté et possède une relation 'student'
if (!$user || !$user->student) {
return redirect()->route('login')->withErrors('Vous devez être connecté en tant qu\'étudiant.');
}

// Passez les données nécessaires à la vue
return view('students.app', [
'student' => $user->student,
]);
}
