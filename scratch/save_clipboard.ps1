Add-Type -AssemblyName System.Windows.Forms
if ([System.Windows.Forms.Clipboard]::ContainsImage()) {
    $img = [System.Windows.Forms.Clipboard]::GetImage()
    $img.Save('C:\Users\sanch\OneDrive\Documents\PlatformIO\Projects\ODDS_Portfolio\scratch\latest_ss.png', [System.Drawing.Imaging.ImageFormat]::Png)
    Write-Output "SAVED"
} else {
    Write-Output "NO_IMAGE"
}
