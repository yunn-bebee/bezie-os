<?PHP class GuardianMiddleware {
    public static function isGuardianAuthenticated() {
        return isset($_SESSION['guardian_id']); // Example session check; adjust as per your authentication logic
    }
}
