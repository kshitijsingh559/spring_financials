const BaseApiUrl = process.env.NEXT_PUBLIC_BASE_API_URL;
const NetworkConstants = {
    URL: {
        BaseAPI: BaseApiUrl,
        LeaderBoard: `${BaseApiUrl}/leaderboard`,
        CreateUser: `${BaseApiUrl}/create-user`,
        AddPoints: `${BaseApiUrl}/add-points`,
        DeleteUser: `${BaseApiUrl}/delete-user`,
    },
    Method: {
        GET: "GET",
        POST: "POST"
    },
    Header: {
        ContentType: "Content-Type",
        ApplicationJson: "application/json",
    },
};
export default NetworkConstants;
