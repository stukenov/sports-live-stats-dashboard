# Sports Live Stats Dashboard

A comprehensive real-time sports statistics and match tracking application built with CodeIgniter 4. This application provides live scores, league tables, match schedules, and detailed statistics for multiple sports including Soccer, Hockey, Basketball, and Tennis.

## Features

- **Real-time Match Tracking**: Get live updates on ongoing matches across multiple sports
- **League Management**: Browse and track various sports leagues worldwide
- **Match Statistics**: View detailed match statistics, team lineups, and historical data
- **Multi-Sport Support**: Currently supports Soccer, Hockey, Basketball, and Tennis
- **League Tables & Standings**: Track team positions and performance in league tables
- **Stage-based Competition Tracking**: Follow different stages of tournaments and leagues
- **Efficient Caching**: Built-in caching mechanism for optimized API calls and faster response times
- **Responsive Design**: User-friendly interface for viewing sports data

## Technology Stack

- **Framework**: CodeIgniter 4
- **PHP Version**: 7.4 or higher (PHP 8.0+ recommended)
- **Database**: SQLite3 (easily switchable to MySQL/MariaDB/PostgreSQL)
- **API Integration**: RapidAPI Sports Data API
- **Caching**: CodeIgniter's built-in caching system

## Prerequisites

- PHP 7.4 or higher (PHP 8.0+ recommended)
- Composer
- Required PHP extensions:
  - intl
  - json
  - mbstring
  - curl
  - sqlite3 (or your preferred database extension)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/stukenov/sports-live-stats-dashboard.git
   cd sports-live-stats-dashboard
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   ```

4. **Set up your environment variables**

   Edit the `.env` file and configure:
   ```
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080'

   # Database configuration
   database.default.DBDriver = SQLite3
   database.default.database = ci4.db

   # RapidAPI credentials (get yours at https://rapidapi.com/)
   RAPIDAPI_KEY = your_rapidapi_key_here
   RAPIDAPI_HOST = livescore6.p.rapidapi.com
   ```

5. **Initialize the database**

   Run the database seeder to create tables and populate initial data:
   ```bash
   php spark db:seed DisciplineSeeder
   php spark db:seed EndpointsSeeder
   php spark db:seed LeaguesSeeder
   php spark db:seed StagesSeeder
   ```

6. **Start the development server**
   ```bash
   php spark serve
   ```

   The application will be available at `http://localhost:8080`

## Configuration

### Database Setup

By default, the application uses SQLite3. To use MySQL or another database:

1. Update your `.env` file:
   ```
   database.default.hostname = localhost
   database.default.database = your_database_name
   database.default.username = your_username
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

### API Configuration

This application uses RapidAPI for sports data. To get your API key:

1. Sign up at [RapidAPI](https://rapidapi.com/)
2. Subscribe to the LiveScore Sports API
3. Copy your API key
4. Update the `RAPIDAPI_KEY` in your `.env` file

## Usage

### Viewing Sports Disciplines

Navigate to the home page to see all available sports disciplines (Soccer, Hockey, Basketball, Tennis).

### Browsing Leagues

Click on any sport to view available leagues for that discipline.

### Viewing Matches

Select a league to see:
- Live matches
- Upcoming fixtures
- Match results
- League standings
- Team statistics

### Data Parsing

To fetch and update sports data from the API:
```bash
# Initialize parser (fetches leagues, stages, and matches)
php spark make:controller Parser
```

Access the parser through your browser:
- `http://localhost:8080/parser/init_parser` - Full data import

## Project Structure

```
sports-live-stats-dashboard/
├── app/
│   ├── Controllers/
│   │   ├── Home.php           # Home page controller
│   │   ├── Matchcenter.php    # Match center and leagues
│   │   ├── Parser.php         # Data parsing and import
│   │   └── Tools.php          # Utility tools
│   ├── Models/
│   │   ├── Disciplines.php    # Sports disciplines model
│   │   ├── Endpoints.php      # API endpoints model
│   │   ├── LeaguesModel.php   # Leagues data model
│   │   ├── LeagueStagesModel.php
│   │   └── LeagueMatchesModel.php
│   ├── Views/
│   │   ├── matchcenter/       # Match center views
│   │   └── templates/         # Layout templates
│   ├── Helpers/
│   │   └── rapidapi_helper.php # API helper functions
│   └── Database/
│       └── Seeds/             # Database seeders
├── public/                    # Public assets and index.php
├── system/                    # CodeIgniter 4 system files
├── writable/                  # Writable directory (logs, cache)
├── .env.example              # Environment configuration example
├── composer.json             # Composer dependencies
└── spark                     # CodeIgniter CLI tool
```

## API Integration

The application integrates with RapidAPI's LiveScore Sports API to fetch:
- Live match data
- League information
- Team statistics
- Match schedules
- League tables and standings

All API calls are cached for 24 hours to minimize API usage and improve performance.

## Development

### Running Tests

```bash
composer test
```

### Code Style

This project follows CodeIgniter 4 coding standards. To check code style:

```bash
composer cs
```

To fix code style issues:

```bash
composer cs:fix
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Built with [CodeIgniter 4](https://codeigniter.com/)
- Sports data provided by [RapidAPI](https://rapidapi.com/)
- Inspired by the need for a comprehensive sports statistics platform

## Support

For issues, questions, or contributions, please open an issue on GitHub.

## Roadmap

- [ ] Add user authentication and profiles
- [ ] Implement favorite teams and leagues
- [ ] Add notifications for live match updates
- [ ] Expand to more sports disciplines
- [ ] Mobile app version
- [ ] Advanced statistics and analytics
- [ ] Match predictions and insights

---

**Note**: This application requires a valid RapidAPI subscription to fetch live sports data. Make sure to configure your API credentials in the `.env` file before running the application.
