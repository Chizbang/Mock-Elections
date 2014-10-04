var app = angular.module("elect", ['dotjem.routing']);

app.service('candidates', function($http){
	var cand = {};

	cand.getCandidates = function(){
		var request = $http.get("api/get_all_parties.php");
		return request;
	};

	cand.voteFor = function(who){
		var	request = $http.get("api/vote_for.php?vote="+who);
		return request;
	};

	cand.getVoteCount = function(){
		var request = $http.get("api/get_vote_count.php");

		return request;
	};

	return cand;
});

app.config(function($locationProvider, $routeProvider, $stateProvider){
	$routeProvider.otherwise({redirectTo:"/home"});

	$stateProvider.state('home', {
		route: '/home',
		views: {
			'main': {
				template: 'template/main.html'
			}
		}
	});
});

app.controller("mainController", function($scope, $interval, candidates){
	$scope.votingFor;
	$scope.availCandidates = [];

	candidates.getCandidates().success(function(reply){
		$scope.availCandidates = reply;
		$scope.voteCount();
		$scope.initVoteCount();
	});
	
	$scope.voteCount = function(){
		candidates.getVoteCount().success(function(reply){
				for (var i = 0; i < reply.length; i++) {
					if(reply[i].party == $scope.availCandidates[i].name){
						$scope.availCandidates[i].votes = reply[i].votes;
					}
				};
			});
	}

	$scope.initVoteCount = function(){
		$interval(function(){$scope.voteCount();}, 2000, 0);
	};

	$scope.disclaimer = function(name){
		$scope.votingFor = name;
	
		$("#candidates").foggy();
		$("#mainOver").css("display","block");
		$("#disclaimer").css("display","block");
		$("#disclaimer").attr("class","animated bounceInDown");
	};

	$scope.vote = function(name){
		candidates.voteFor(name).success(
			function(reply){
				if(reply.error){
					$scope.failTrans();
				} else{
					$scope.successTrans();
				}
		});
	};

	$scope.failTrans = function(){
		alert("You've already voted!");
		$("#disclaimer").attr("class","animated zoomOut");
		
		$("#disclaimer").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$("#disclaimer").css("display", "none");
			$("#mainOver").css("display", "none");
			$("#candidates").foggy(false);
		});
	}

	$scope.successTrans = function(){
		$("#disclaimer").attr("class","animated zoomOut");
		$("#disclaimer").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$("#disclaimer").css("display","none");
			$("#success").css("display", "block");
			$("#success").attr("class","animated fadeIn");	
			$interval(function() {
				$("#success").css("display", "none");
				$("#mainOver").css("display", "none");
				$("#candidates").foggy(false);
			}, 5000, 1);
		});
		
	}

});
