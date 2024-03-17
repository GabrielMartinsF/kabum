export function authHeader () {
    let token = localStorage.getItem('token');

    token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c3VhcmlvIjoiMTEiLCJsb2dpbiI6ImxvZ2luIn0.h0VyuDtUqYJhutdlrTy7uptbOlRreiCKsN4kUQ3Zuyg"

    if(token) {
        return { Authorization: 'Bearer ' + token }
    } else {
        return {}
    }
}