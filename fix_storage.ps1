$path = "c:\xampp\htdocs\mltvenecom\public\storage"
$target = "c:\xampp\htdocs\mltvenecom\storage\app\public"

Write-Output "Checking $path..."

if (Test-Path $path) {
    $item = Get-Item $path
    if ($item.Attributes -match "ReparsePoint") {
        Write-Output "It is a Symlink/Junction. Removing..."
        cmd /c rmdir "$path"
        if (Test-Path $path) { Write-Output "Failed to remove symlink." } else { Write-Output "Removed symlink." }
    } else {
        Write-Output "It is a Directory. Renaming to storage_old..."
        Rename-Item -Path $path -NewName "storage_old" -ErrorAction SilentlyContinue
        if (Test-Path $path) {
            Write-Output "Rename failed. Attempts to move..."
            Move-Item -Path $path -Destination "c:\xampp\htdocs\mltvenecom\public\storage_old_$(Get-Date -Format 'yyyyMMddHHmmss')"
        }
    }
} else {
    Write-Output "Path does not exist."
}

if (-not (Test-Path $path)) {
    Write-Output "Creating Symlink..."
    cmd /c mklink /D "$path" "$target"
} else {
    Write-Output "Could not clear path for symlink."
}
