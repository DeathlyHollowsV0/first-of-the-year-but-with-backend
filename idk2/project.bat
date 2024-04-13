
pushd "C:\xampp\htdocs\project_final"
start "" /B "C:\xampp\php\php.exe" artisan serve --quiet
start "" http://localhost:8000
popd