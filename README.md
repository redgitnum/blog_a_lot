
# Blog-a-lot

### About
- App created to mimic some functionality of medium.com
- Project build entirely in Laravel(PHP)
- All user information, posts, comments, etc. are securely stored in MySQL database

### Features

- Login / Register - login to your account or create new user, sensitive information is hashed(no need for real email as there is no need for email confirmation, and I don't use it for anything other than when logging in)
- Create new post - only available for logged users, does exactly what it says :)
- Searchbar - search all post titles and return a list of found articles
- Post page - when you click on a post, you will get the full article content with author summary, comment section and ability to comment if you are logged
- Dashboard - when logged you can see all your posts, comments and votes with your account summary and the ability to manage your content, change your password or delete your account
- User page - when you click on author/user name, you will get the same view as in dashboard without management options(unless you are that user logged in)
- Voting - as a logged user you can vote for a post if you like it, you can remove it but you cannot vote more than one time for a single article
- Commenting - as a logged user you can comment on post page, multiple comments allowed
- Sorting - you can sort the list of articles by latest/most votes(applies to homepage view and each category)
- Categories - check only the posts with a given category