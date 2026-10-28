 ITRACKB4 Laboratory Activity 1

G1. Route model binding needs the route parameter name to match the controller method's variable name (such as `{movie}` and `Movie $movie`), and the variable must be type-hinted with the Eloquent model class. If only the names match, Laravel passes the raw ID string instead of a model. If only the type-hint is present, the names don't match, so Laravel injects an empty `Movie` instance and the ID is never looked up.

G2. The link `/movies/1/delete` matches no registered route, so Laravel returns a 404 even though the URL looks right. The delete route is `DELETE /movies/{movie}`, which is only reached by a form that sends a DELETE request, not by a link that sends a GET request.

G3. If the second argument is left out, `old('title')` returns null on first load, so the edit form shows blank fields and saving would overwrite the movie with empty values. If only `$movie->title` is used without `old()`, the form loses what the user typed after a failed validation and shows the original values again.