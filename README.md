# Contao Database Cache

This module offers functionality for storing arbitrary values to database.

## Technical instructions

After defining the maximum cache time in the contao settings, you can retrieve the result for a certain request by using the following code (of course, retrieved from cache if there's already a cached result which isn't outdated):

```
if (($strValue = DatabaseCache::getValue($strKey)) !== false)
{
    $strResult = $strValue;
}
else
{
    // do some logic in order to create $strResult
    $strResult = someFunction();
    DatabaseCache::cacheValue($strKey, $strResult);
}
```