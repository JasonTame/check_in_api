# Authenticating requests

This API is authenticated by sending an **`Authorization`** header with the value **`"Bearer {YOUR_AUTH_KEY}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

You can get a token for testing purposes by using the create account API call and copying the token, or by running php artisan generate:token.
