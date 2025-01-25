
<?php
use Illuminate\Http\Request;


 function getLanguage(Request $request)
{
     $text = $request->path();
     $parts = explode('/', $text);
     $language = $parts[1]; // $language = "ar"
     return $language;

}
function uploadFile(Request $request, string $fieldName, string $folder): ?string
{
    if ($request->hasFile($fieldName)) {
        $file = $request->file($fieldName); // Removed extra space
        $fileName = $folder . '/' . uniqid() . '.' . $file->getClientOriginalExtension(); // Added slash and used getClientOriginalExtension()
        $file->storePubliclyAs('public', $fileName); // Store in the 'public' disk
        return $fileName;
    }

    return null; // Return null if no file is uploaded
}
