$cutoff = (Get-Date).AddMinutes(-30)
Get-ChildItem -Path "C:\Users\sanch\Pictures", "C:\Users\sanch\Desktop", "C:\Users\sanch\OneDrive" -Recurse -File -ErrorAction SilentlyContinue | Where-Object { $_.LastWriteTime -gt $cutoff -and ($_.Extension -in '.png','.jpg','.jpeg') } | Select-Object FullName, LastWriteTime
