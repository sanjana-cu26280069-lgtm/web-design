// Example browser client. Keep the token in a secure server-side session where possible.
const API_URL = '/api/products_api.php';
async function loadProducts(apiToken) {
  const response = await fetch(API_URL, {
    headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${apiToken}` }
  });
  if (!response.ok) throw new Error(`API error: ${response.status}`);
  return response.json();
}
