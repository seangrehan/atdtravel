ATD Travel

This project is built in Symfony.

For anyone trying to recreate this project, the first steps would be to identify the most important features to work on first and then go from there, for example:

    . The search web page
    . The routing
    . Backend code to fetch and process the API results
    . Code to display the results into a table.
    . Pagination
    . Search by title function
    . Search by geo region
    . Frontend styling

The ideal way to develop this project would be a TDD approach, so create a test before the code to make that test pass. This generally makes your code more reliable. However this can be difficult but I would recommend writing tests before working on the frontend styling, so that you can find any bugs before they are harder to remove. This project doesn't require any database as the information comes from the API requests so you can just add the packages you need as you need them. When testing the API connection, it would be better to mock the results so that the tests don't rely on an external dependancy which could produce inconsistant results.

If this project could be improved, then more edge case tests would be useful. The search functionality could be changed to AJAX to improve loading speed, so for this I would use VueJS. The loading speed is also constricted by the API response time, the problem with caching these results would be that you wouldn't know when they would go stale, so this could be fixed by an additional API call just to get the last updated time for the ATD system (if this endpoint exists), so if the cache is stale then the page could fetch new results automatically.
